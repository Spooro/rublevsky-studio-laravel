document.addEventListener('alpine:init', () => {
    Alpine.data('videoHandler', () => ({
        initVideo(videoElement) {
            if (!videoElement) return;

            const playVideo = () => {
                videoElement.play().catch(error => {
                    console.warn('Video autoplay failed:', error);
                    // Retry playback on user interaction
                    document.addEventListener('click', () => {
                        videoElement.play().catch(e => console.warn('Retry failed:', e));
                    }, { once: true });
                });
            };

            // Initial play attempt
            playVideo();

            // Handle visibility changes
            document.addEventListener('visibilitychange', () => {
                if (document.visibilityState === 'visible') {
                    playVideo();
                }
            });

            // Handle Livewire navigation
            document.addEventListener('livewire:navigated', () => {
                playVideo();
            });
        },

        reinitVideo(videoElement) {
            if (!videoElement) return;

            // Reset the video
            videoElement.currentTime = 0;

            // Attempt to play
            this.initVideo(videoElement);
        }
    }));
});

// Global handler for videos that don't have explicit Alpine initialization
document.addEventListener('livewire:navigated', () => {
    document.querySelectorAll('video:not([x-data])').forEach(video => {
        video.play().catch(e => console.warn('Global video play failed:', e));
    });
});
