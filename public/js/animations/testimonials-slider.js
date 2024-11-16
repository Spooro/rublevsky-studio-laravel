function initializeTestimonialsSlider() {
    // Ensure Swiper is available
    if (typeof Swiper === 'undefined') {
        console.warn('Swiper not loaded yet, retrying in 100ms');
        setTimeout(initializeTestimonialsSlider, 100);
        return;
    }

    const sliderElement = document.querySelector('.tinyflow-slider');
    if (!sliderElement) return;

    // Destroy existing swiper instance if it exists
    if (window.testimonialSwiper) {
        window.testimonialSwiper.destroy(true, true);
    }

    const defaultDeg = 5;
    try {
        window.testimonialSwiper = new Swiper(".tinyflow-slider", {
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
            effect: "coverflow",
            coverflowEffect: {
                rotate: 0,
                stretch: 48,
                depth: 0,
                slideShadows: false,
                modifier: 1
            },
            on: {
                beforeInit: function(swiper) {
                    swiper.params.coverflowEffect.rotate = swiper.el.dataset.rotate * -1 || (defaultDeg * -1);
                    swiper.params.speed = swiper.el.dataset.speed * 1 || swiper.params.speed;
                },
                init: function(swiper) {
                    let maxCardWidth = 0;
                    let maxCardHeight = 0;
                    swiper.slides.forEach(slideItem => {
                        maxCardWidth = Math.max(maxCardWidth, slideItem.getBoundingClientRect().width);
                        maxCardHeight = Math.max(maxCardHeight, slideItem.offsetHeight);
                    });
                    swiper.el.style.cssText = `--_min-card-height: ${maxCardHeight}px`;
                }
            }
        });

        // Add a flag to indicate successful initialization
        window.testimonialSwiper.initialized = true;

        console.log('Testimonials slider initialized successfully');
    } catch (error) {
        console.error('Error initializing testimonials slider:', error);
    }
}

// Initialize on script load
initializeTestimonialsSlider();

// Re-initialize on Livewire navigation
document.addEventListener('livewire:navigated', () => {
    // Check if we're on the work page
    if (document.querySelector('.tinyflow-slider')) {
        console.log('Reinitializing testimonials slider after navigation');
        // Give DOM time to update
        setTimeout(initializeTestimonialsSlider, 200);
    }
});

// Backup initialization for edge cases
window.addEventListener('load', () => {
    if (document.querySelector('.tinyflow-slider') &&
        (!window.testimonialSwiper || !window.testimonialSwiper.initialized)) {
        console.log('Backup initialization of testimonials slider');
        initializeTestimonialsSlider();
    }
});
