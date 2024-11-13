document.addEventListener('DOMContentLoaded', () => {
    // Skip if already shown in this session
    if (sessionStorage.getItem('loaderShown')) {
        document.querySelector('.loader-wrap').style.display = 'none';
        document.body.classList.add('loaded');
        document.body.style.overflow = 'auto';
        return;
    }

    const start = performance.now();

    // Import imagesLoaded
    const script = document.createElement('script');
    script.src = 'https://unpkg.com/imagesloaded@5/imagesloaded.pkgd.min.js';

    script.onload = () => {
        const imgLoad = imagesLoaded('body', { background: true }, onImagesLoaded);
        const numImages = imgLoad.images.length;

        // Handle progress
        imgLoad.on('progress', (instance, image) => {
            const progress = instance.progressedCount / numImages;

            document.querySelector('.loader-percent').textContent =
                `${Math.round(progress * 100)}%`;

            gsap.to('.progress-bar', {
                scaleX: progress,
                duration: 0.3
            });
        });
    };

    document.head.appendChild(script);

    function onImagesLoaded() {
        const end = performance.now();
        const MIN_TIME = 1000;
        const duration = end - start;
        const remainingTime = Math.max(MIN_TIME - duration, 0);

        // Show content before loader slides away
        document.body.classList.add('loaded');

        gsap.to('.loader-wrap', {
            yPercent: -100,
            delay: remainingTime / 1000,
            duration: 1,
            ease: 'power2.inOut',
            onComplete: () => {
                document.querySelector('.loader-wrap').style.display = 'none';
                gsap.set('body', { overflow: 'auto' });
                sessionStorage.setItem('loaderShown', 'true');
            }
        });
    }
});
