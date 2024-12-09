
    document.addEventListener('livewire:navigated', () => {
        document.querySelectorAll('video').forEach(video => {
            video.play().catch(e => console.log('Video play failed:', e));
        });
    });

    document.addEventListener('visibilitychange', () => {
        if (document.visibilityState === 'visible') {
            document.querySelectorAll('video').forEach(video => {
                video.play().catch(e => console.log('Video play failed:', e));
            });
        }
    });
