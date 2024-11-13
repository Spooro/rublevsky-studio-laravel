document.addEventListener('DOMContentLoaded', initLoader);
document.addEventListener('livewire:navigated', () => {
    // Reset loader state
    const loaderWrap = document.querySelector('.loader-wrap');
    loaderWrap.style.transform = 'translateY(0)';
    loaderWrap.style.display = 'flex';
    document.body.style.overflow = 'hidden';

    // Reset progress elements
    const progressBar = document.querySelector('.progress-bar');
    const loaderPercent = document.querySelector('.loader-percent');
    gsap.set(progressBar, { scaleX: 0 });
    loaderPercent.textContent = '0%';

    initLoader();
});

function initLoader() {
    const start = performance.now();

    // Load imagesLoaded if not already loaded
    if (typeof imagesLoaded === 'undefined') {
        const script = document.createElement('script');
        script.src = 'https://unpkg.com/imagesloaded@5/imagesloaded.pkgd.min.js';
        script.onload = () => startImageLoading(start);
        document.head.appendChild(script);
    } else {
        startImageLoading(start);
    }
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
            gsap.set('body', { overflow: 'auto' });
            gsap.set('.loader-wrap', { display: 'none' });
        }
    });
}
