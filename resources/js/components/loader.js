// Flag to track if we're in pre-navigation state
let isPreNavigationState = false;

document.addEventListener('click', (e) => {
    const link = e.target.closest('a[href]');
    if (link && link.href.startsWith(window.location.origin)) {
        const mainRoutes = ['/work', '/store', '/contact'];
        const targetPath = new URL(link.href).pathname;

        if (mainRoutes.some(route => targetPath === route)) {
            e.preventDefault();
            isPreNavigationState = true;

            const loaderWrap = document.querySelector('.loader-wrap');
            if (loaderWrap) {
                const pageWrapper = loaderWrap.closest('.page-with-loader');
                if (pageWrapper) {
                    pageWrapper.classList.remove('loader-hidden');
                }

                loaderWrap.style.display = 'flex';
                loaderWrap.style.opacity = '0';

                // Reset to initial state
                const progressBar = document.querySelector('.progress-bar');
                const loaderPercent = document.querySelector('.loader-percent');
                if (progressBar && loaderPercent) {
                    gsap.set(progressBar, { scaleX: 0 });
                    loaderPercent.textContent = '0%';
                }

                // Fade in the loader and navigate
                gsap.to(loaderWrap, {
                    opacity: 1,
                    duration: 0.5,
                    ease: 'power2.inOut',
                    onComplete: () => {
                        window.location.href = link.href;
                    }
                });
            } else {
                window.location.href = link.href;
            }
        }
    }
});

document.addEventListener('livewire:navigated', () => {
    // Skip loader initialization if we're still in pre-navigation state
    if (isPreNavigationState) {
        isPreNavigationState = false;
        return;
    }

    const loaderWrap = document.querySelector('.loader-wrap');
    if (!loaderWrap) {
        return;
    }

    // Initialize loader for actual image loading
    initLoader();
});

function initLoader() {
    const loaderWrap = document.querySelector('.loader-wrap');
    if (!loaderWrap) {
        return;
    }

    const start = performance.now();
    startImageLoading(start);
}

function startImageLoading(start) {
    const imgLoad = imagesLoaded('body', { background: true }, () => onImagesLoaded(start));
    const numImages = imgLoad.images.length;

    imgLoad.on('progress', (instance, image) => {
        const progress = instance.progressedCount / numImages;

        document.querySelector('.loader-percent').textContent =
            `${Math.round(progress * 100)}%`;

        gsap.to('.progress-bar', {
            scaleX: progress,
            duration: 0.3,
            ease: 'power1.out'
        });
    });
}

function onImagesLoaded(start) {
    const loaderWrap = document.querySelector('.loader-wrap');
    if (!loaderWrap) {
        return;
    }

    const pageWrapper = loaderWrap.closest('.page-with-loader');
    const end = performance.now();
    const MIN_TIME = 1000;
    const duration = end - start;
    const remainingTime = Math.max(MIN_TIME - duration, 0);

    gsap.to('.loader-wrap', {
        opacity: 0,
        delay: remainingTime / 1000,
        duration: 0.5,
        ease: 'power2.inOut',
        onComplete: () => {
            gsap.set('.loader-wrap', { display: 'none' });
            if (pageWrapper) {
                pageWrapper.classList.add('loader-hidden');
            }

            const progressBar = document.querySelector('.progress-bar');
            const loaderPercent = document.querySelector('.loader-percent');
            if (progressBar && loaderPercent) {
                gsap.set(progressBar, { scaleX: 0 });
                loaderPercent.textContent = '0%';
            }
        }
    });
}
