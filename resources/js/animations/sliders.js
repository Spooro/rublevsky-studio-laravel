class SliderManager {
    constructor() {
        this.testimonialSwiper = null;
        this.blogImageSwipers = [];
        this.initialized = false;
    }

    init() {
        if (!window.Swiper) {
            console.warn('Swiper not loaded, retrying in 100ms');
            setTimeout(() => this.init(), 100);
            return;
        }

        this.initializeSliders();
        this.bindEvents();
    }

    initializeSliders() {
        // Only initialize sliders that exist on the current page
        if (document.querySelector('.tinyflow-slider')) {
            this.initializeTestimonials();
        }

        if (document.querySelector('.blog-images-slider')) {
            this.initializeBlogImages();
        }
    }

    initializeTestimonials() {
        // Cleanup existing instance if any
        if (this.testimonialSwiper) {
            this.testimonialSwiper.destroy(true, true);
        }

        const element = document.querySelector('.tinyflow-slider');
        if (!element) return;

        this.testimonialSwiper = new Swiper(element, {
            slidesPerView: "auto",
            spaceBetween: 0,
            threshold: 0,
            freeMode: true,
            grabCursor: true,
            loop: false,
            keyboard: {
                enabled: true,
                onlyInViewport: true,
            },
            mousewheel: {
                forceToAxis: true,
                sensitivity: 1,
                releaseOnEdges: true,
            },
            effect: "coverflow",
            coverflowEffect: {
                rotate: 0,
                stretch: 35,
                depth: 0,
                slideShadows: false,
                modifier: 1
            },
            on: {
                beforeInit: (swiper) => {
                    const defaultDeg = 5;
                    swiper.params.coverflowEffect.rotate = swiper.el.dataset.rotate * -1 || (defaultDeg * -1);
                    swiper.params.speed = swiper.el.dataset.speed * 1 || swiper.params.speed;
                },
                init: (swiper) => {
                    let maxCardHeight = Math.max(...Array.from(swiper.slides)
                        .map(slide => slide.offsetHeight));
                    swiper.el.style.setProperty('--_min-card-height', `${maxCardHeight}px`);
                }
            }
        });
    }

    initializeBlogImages() {
        this.cleanupBlogSliders();

        document.querySelectorAll('.blog-images-slider').forEach(element => {
            const postId = element.dataset.postId;

            const images = element.querySelectorAll('img');
            Promise.all(Array.from(images).map(img => {
                if (img.complete) return Promise.resolve();
                return new Promise(resolve => {
                    img.onload = resolve;
                });
            })).then(() => {
                const swiper = new Swiper(element, {
                    slidesPerView: "auto",
                    spaceBetween: -100,
                    threshold: 0,
                    centeredSlides: true,
                    grabCursor: true,
                    loop: false,
                    initialSlide: 0,
                    keyboard: {
                        enabled: true,
                        onlyInViewport: true,
                    },
                    mousewheel: {
                        forceToAxis: true,
                        sensitivity: 0.01,
                        releaseOnEdges: true,
                        thresholdDelta: 5
                    },
                    effect: "coverflow",
                    coverflowEffect: {
                        rotate: 5,
                        stretch: 0,
                        depth: 100,
                        modifier: 1,
                        slideShadows: false,
                    },
                    on: {
                        slideChange: function() {
                            // Update preview active state
                            const activeIndex = this.activeIndex;
                            const postId = this.el.dataset.postId;
                            updatePreviewActive(postId, activeIndex);
                        }
                    }
                });

                this.blogImageSwipers.push({ id: postId, instance: swiper });

                // Initialize preview clicks
                this.initializePreviewClicks(postId);

                // Set initial active preview
                updatePreviewActive(postId, 0);
            });
        });
    }

    initializePreviewClicks(postId) {
        const previewContainer = document.getElementById(`preview-container-${postId}`);
        if (!previewContainer) return;

        const previews = previewContainer.querySelectorAll('.preview-image-wrapper');
        previews.forEach(preview => {
            preview.addEventListener('click', () => {
                const index = parseInt(preview.dataset.index);
                const swiper = this.blogImageSwipers.find(s => s.id === postId)?.instance;
                if (swiper) {
                    swiper.slideTo(index);
                }
            });
        });
    }

    cleanupBlogSliders() {
        this.blogImageSwipers.forEach(({ instance }) => {
            if (instance && typeof instance.destroy === 'function') {
                instance.destroy(true, true);
            }
        });
        this.blogImageSwipers = [];
    }

    cleanup() {
        if (this.testimonialSwiper) {
            this.testimonialSwiper.destroy(true, true);
            this.testimonialSwiper = null;
        }
        this.cleanupBlogSliders();
    }

    bindEvents() {
        if (this.initialized) return;

        document.addEventListener('livewire:navigated', () => {
            // Small delay to ensure DOM is ready
            setTimeout(() => this.initializeSliders(), 50);
        });

        document.addEventListener('livewire:navigating', () => {
            this.cleanup();
        });

        this.initialized = true;
    }
}

// Add this helper function outside the class
function updatePreviewActive(postId, activeIndex) {
    const previewContainer = document.getElementById(`preview-container-${postId}`);
    if (!previewContainer) return;

    // Remove active class from all previews
    previewContainer.querySelectorAll('.preview-image-wrapper').forEach(preview => {
        preview.classList.remove('active');
    });

    // Add active class to current preview
    const activePreview = previewContainer.querySelector(
        `.preview-image-wrapper[data-index="${activeIndex}"]`
    );
    if (activePreview) {
        activePreview.classList.add('active');

        // Center the active preview
        const containerWidth = previewContainer.offsetWidth;
        const previewWidth = activePreview.offsetWidth;
        const scrollLeft = activePreview.offsetLeft - (containerWidth / 2) + (previewWidth / 2);

        previewContainer.scrollTo({
            left: scrollLeft,
            behavior: 'smooth'
        });
    }
}

// Create and initialize the manager
const sliderManager = new SliderManager();
document.addEventListener('DOMContentLoaded', () => sliderManager.init());
