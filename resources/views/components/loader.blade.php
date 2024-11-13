<div x-data="loader" x-show="isLoading" x-transition:leave="transition-transform duration-1000"
    x-transition:leave-start="transform translate-y-0" x-transition:leave-end="transform -translate-y-full"
    class="fixed inset-0 z-[99999] flex items-center justify-center bg-white">
    <div class="text-center opacity-0 transition-opacity duration-400" x-ref="loaderContent"
        :class="{ 'opacity-100': contentVisible }">
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
            contentVisible: false,
            progress: 0,
            totalAssets: 0,
            loadedAssets: 0,

            async init() {
                // Check if loader has been shown in this session
                if (sessionStorage.getItem('loaderShown')) {
                    this.isLoading = false;
                    return;
                }

                // Fade in loader contents after a short delay
                setTimeout(() => {
                    this.contentVisible = true;
                }, 100);

                // Get all images and spline viewer
                const images = document.querySelectorAll('img');
                const splineViewer = document.querySelector('spline-viewer');

                // Calculate total assets to load
                this.totalAssets = images.length + (splineViewer ? 1 : 0);

                // If there are no assets to load, show 100% immediately
                if (this.totalAssets === 0) {
                    this.progress = 100;
                    this.$refs.progressBar.style.transform = 'scaleX(1)';
                } else {
                    // Load images
                    const imagePromises = Array.from(images).map(img => this.loadImage(img));

                    // Load spline if it exists
                    let splinePromise = Promise.resolve();
                    if (splineViewer) {
                        splinePromise = new Promise((resolve) => {
                            splineViewer.addEventListener('load-start', () => {
                                console.log('Spline loading started');
                            });

                            splineViewer.addEventListener('load-complete', () => {
                                console.log('Spline loading completed');
                                this.incrementProgress();
                                resolve();
                            });
                        });
                    }

                    // Wait for all assets to load
                    await Promise.all([...imagePromises, splinePromise]);
                }

                // Ensure minimum display time
                await new Promise(resolve => setTimeout(resolve, 1000));

                // Mark loader as shown for this session
                sessionStorage.setItem('loaderShown', 'true');

                // Hide loader
                this.isLoading = false;

                // Enable scrolling
                document.body.style.overflow = 'auto';
            },

            loadImage(img) {
                return new Promise((resolve) => {
                    if (img.complete) {
                        this.incrementProgress();
                        resolve();
                    } else {
                        img.addEventListener('load', () => {
                            this.incrementProgress();
                            resolve();
                        });
                        img.addEventListener('error', () => {
                            this.incrementProgress();
                            resolve();
                        });
                    }
                });
            },

            incrementProgress() {
                this.loadedAssets++;
                this.progress = Math.round((this.loadedAssets / this.totalAssets) * 100);
                this.$refs.progressBar.style.transform =
                    `scaleX(${this.loadedAssets / this.totalAssets})`;
            }
        }));
    });
</script>
