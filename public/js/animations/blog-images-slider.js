let blogImageSwipers = [];

function initializeBlogImageSliders() {
    if (typeof Swiper === 'undefined') {
        console.warn('Swiper not loaded yet');
        return;
    }

    // Clean up existing blog image swipers
    destroyBlogImageSliders();

    // Initialize new sliders for each blog post
    document.querySelectorAll('.blog-images-slider').forEach(slider => {
        const postId = slider.dataset.postId;

        const swiper = new Swiper(slider, {
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
            effect: "coverflow",
            coverflowEffect: {
                rotate: 5,
                stretch: 0,
                depth: 100,
                modifier: 1,
                slideShadows: false,
            }
        });

        blogImageSwipers.push({ id: postId, instance: swiper });
    });
}

function destroyBlogImageSliders() {
    blogImageSwipers.forEach(({ instance }) => {
        if (instance) {
            instance.destroy(true, true);
        }
    });
    blogImageSwipers = [];
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', () => {
    setTimeout(initializeBlogImageSliders, 100);
});

// Handle Livewire navigation
document.addEventListener('livewire:navigated', () => {
    setTimeout(initializeBlogImageSliders, 100);
});

// Cleanup on navigation away
document.addEventListener('livewire:navigating', () => {
    destroyBlogImageSliders();
});
