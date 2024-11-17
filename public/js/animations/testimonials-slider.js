function initializeTestimonialsSlider() {
    const sliderElement = document.querySelector('.tinyflow-slider');
    if (!sliderElement) return;

    // Ensure Swiper is available
    if (typeof Swiper === 'undefined') {
        console.warn('Swiper not loaded');
        return;
    }

    // Destroy existing swiper instance if it exists
    if (window.testimonialSwiper && window.testimonialSwiper.destroy) {
        window.testimonialSwiper.destroy(true, true);
    }

    // Small delay to ensure DOM is fully ready
    setTimeout(() => {
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
    }, 100);

    return window.testimonialSwiper;
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', initializeTestimonialsSlider);

// Initialize on Livewire navigation
document.addEventListener('livewire:navigated', () => {
    setTimeout(initializeTestimonialsSlider, 100);
});

// Cleanup on navigation
document.addEventListener('livewire:navigating', () => {
    if (window.testimonialSwiper && window.testimonialSwiper.destroy) {
        window.testimonialSwiper.destroy(true, true);
    }
});
