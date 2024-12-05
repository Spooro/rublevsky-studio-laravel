let testimonialSwiper;

function initializeTestimonialsSlider() {
    // Wait for DOM to be fully ready
    if (typeof Swiper === 'undefined') {
        console.warn('Swiper not loaded yet');
        return;
    }

    const sliderElement = document.querySelector('.tinyflow-slider');
    if (!sliderElement) {
        console.warn('Slider element not found');
        return;
    }

    // Clean up existing instance
    if (testimonialSwiper) {
        testimonialSwiper.destroy(true, true);
        testimonialSwiper = null;
    }

    const defaultDeg = 5;
    testimonialSwiper = new Swiper(".tinyflow-slider", {
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

    return testimonialSwiper;
}

// Cleanup function
function destroyTestimonialsSlider() {
    if (testimonialSwiper) {
        testimonialSwiper.destroy(true, true);
        testimonialSwiper = null;
    }
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', () => {
    setTimeout(initializeTestimonialsSlider, 100);
});

// Handle Livewire navigation
document.addEventListener('livewire:navigated', () => {
    // First destroy the old instance
    destroyTestimonialsSlider();

    // Then initialize new instance with a delay
    setTimeout(initializeTestimonialsSlider, 100);
});

// Cleanup on navigation away
document.addEventListener('livewire:navigating', () => {
    destroyTestimonialsSlider();
});
