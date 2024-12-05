function initScrollProgress() {
    const content = document.querySelector('.content');

    if (!content) return;

    const calculateProgress = () => {
        const windowHeight = window.innerHeight;
        const scrollTop = window.scrollY;
        const scrollHeight = content.scrollHeight - windowHeight;
        const progress = Math.round((scrollTop / scrollHeight) * 100);

        document.documentElement.style.setProperty('--progress',
            Math.min(Math.max(progress, 0), 100));
    };

    window.addEventListener('scroll', calculateProgress);
    window.addEventListener('resize', calculateProgress);
    calculateProgress();
}

// Initialize on DOMContentLoaded
document.addEventListener('DOMContentLoaded', initScrollProgress);

// Export for Livewire navigation
window.initScrollProgress = initScrollProgress;
