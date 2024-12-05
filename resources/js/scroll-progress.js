function initScrollProgress() {
    const content = document.querySelector('.content');
    const progressElement = document.querySelector('.progress');

    if (!content || !progressElement) return;

    const calculateProgress = () => {
        const scrollTop = window.scrollY;
        const docHeight = content.offsetHeight;
        const winHeight = window.innerHeight;
        const scrollPercent = scrollTop / (docHeight - winHeight);
        const scrollPercentRounded = Math.round(scrollPercent * 100);

        // Ensure the percentage stays between 0 and 100
        const finalPercent = Math.min(Math.max(scrollPercentRounded, 0), 100);
        progressElement.textContent = `${finalPercent}%`;
    };

    // Use requestAnimationFrame for smoother updates
    let ticking = false;
    window.addEventListener('scroll', () => {
        if (!ticking) {
            window.requestAnimationFrame(() => {
                calculateProgress();
                ticking = false;
            });
            ticking = true;
        }
    });

    window.addEventListener('resize', calculateProgress);
    calculateProgress();
}

document.addEventListener('DOMContentLoaded', initScrollProgress);
window.initScrollProgress = initScrollProgress;
