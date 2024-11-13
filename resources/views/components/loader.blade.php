<div x-data="loader" x-show="isLoading" x-transition:leave="transition-transform duration-1000"
    x-transition:leave-start="transform translate-y-0" x-transition:leave-end="transform -translate-y-full"
    class="fixed inset-0 z-[99999] flex items-center justify-center bg-white" x-init="$watch('isLoading', value => document.body.style.overflow = value ? 'hidden' : 'auto');
    // Remove initial loader once Alpine loader is ready
    document.getElementById('initial-loader')?.remove();">
    <div class="text-center opacity-0 transition-opacity duration-300" :class="{ 'opacity-100': true }">
        <div class="w-64 h-1 bg-gray-200 rounded-full overflow-hidden">
            <div class="h-full bg-black origin-left transform scale-x-0 transition-transform duration-300"
                x-ref="progressBar"></div>
        </div>
        <div class="mt-4 text-xl" x-text="`${progress}%`"></div>
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('loader', () => ({
            isLoading: true,
            progress: 0,
            totalWeight: 0,
            loadedWeight: 0,

            weights: {
                image: 1,
                video: 5,
                spline: 5,
            },

            async init() {
                // Set initial overflow state
                document.body.style.overflow = 'hidden';

                if (sessionStorage.getItem('loaderShown')) {
                    this.isLoading = false;
                    return;
                }

                const images = document.querySelectorAll('img');
                const videos = document.querySelectorAll('video');
                const splineViewer = document.querySelector('spline-viewer');

                // Calculate total weight
                this.totalWeight =
                    (images.length * this.weights.image) +
                    (videos.length * this.weights.video) +
                    (splineViewer ? this.weights.spline : 0);

                if (this.totalWeight === 0) {
                    this.progress = 100;
                    this.$refs.progressBar.style.transform = 'scaleX(1)';
                } else {
                    const imagePromises = Array.from(images).map(img => this.loadImage(img));
                    const videoPromises = Array.from(videos).map(video => this.loadVideo(
                        video));

                    let splinePromise = Promise.resolve();
                    if (splineViewer) {
                        splinePromise = new Promise((resolve) => {
                            splineViewer.addEventListener('load-start', () => {
                                console.log('Spline loading started');
                            });

                            splineViewer.addEventListener('load-complete', () => {
                                console.log('Spline loading completed');
                                this.incrementProgress(this.weights.spline);
                                resolve();
                            });
                        });
                    }

                    await Promise.all([...imagePromises, ...videoPromises, splinePromise]);
                }

                await new Promise(resolve => setTimeout(resolve, 1000));
                sessionStorage.setItem('loaderShown', 'true');
                this.isLoading = false;
                document.body.style.overflow = 'auto';
            },

            loadImage(img) {
                return new Promise((resolve) => {
                    if (img.complete) {
                        this.incrementProgress(this.weights.image);
                        resolve();
                    } else {
                        img.addEventListener('load', () => {
                            this.incrementProgress(this.weights.image);
                            resolve();
                        });
                        img.addEventListener('error', () => {
                            this.incrementProgress(this.weights.image);
                            resolve();
                        });
                    }
                });
            },

            loadVideo(video) {
                return new Promise((resolve) => {
                    if (video.readyState >= 2) {
                        this.incrementProgress(this.weights.video);
                        resolve();
                    } else {
                        video.addEventListener('loadeddata', () => {
                            this.incrementProgress(this.weights.video);
                            resolve();
                        });
                        video.addEventListener('error', () => {
                            this.incrementProgress(this.weights.video);
                            resolve();
                        });
                    }
                });
            },

            incrementProgress(weight) {
                this.loadedWeight += weight;
                this.progress = Math.round((this.loadedWeight / this.totalWeight) * 100);
                this.$refs.progressBar.style.transform =
                    `scaleX(${this.loadedWeight / this.totalWeight})`;
            }
        }));
    });
</script>
