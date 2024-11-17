function initializeTestimonialsSlider() {
    const sliderElement = document.querySelector('.tinyflow-slider');
    if (!sliderElement) return;

    // Destroy existing swiper instance if it exists
    if (window.testimonialSwiper) {
        window.testimonialSwiper.destroy(true, true);
    }

    const defaultDeg = 5;
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

    return window.testimonialSwiper;
}

// Initialize on page load and Livewire navigation
document.addEventListener('DOMContentLoaded', initializeTestimonialsSlider);
document.addEventListener('livewire:navigated', () => {
    // Small delay to ensure DOM is ready
    setTimeout(initializeTestimonialsSlider, 0);
});
