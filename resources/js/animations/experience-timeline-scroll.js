import gsap from 'gsap';
import ScrollTrigger from 'gsap/ScrollTrigger';

const TimelineManager = {
    init() {
        gsap.registerPlugin(ScrollTrigger);
        this.initializeTimeline();

        // Handle Livewire navigation
        document.addEventListener('livewire:navigating', () => {
            ScrollTrigger.getAll().forEach(st => st.kill());
        });

        document.addEventListener('livewire:navigated', () => {
            setTimeout(() => this.initializeTimeline(), 50);
        });
    },

    initializeTimeline() {
        const items = document.querySelectorAll('.experience_timeline_item');
        const progressElements = '.experience_timeline_progress, .experience_timeline_progress_bar';

        if (items.length === 0) return;

        // Set initial states
        gsap.set('.experience_timeline_right, .experience_timeline_date-text', {
            opacity: 0.20
        });
        gsap.set('.experience_timeline_circle', {
            backgroundColor: '#e5e5e5'
        });
        gsap.set(progressElements, {
            opacity: 0
        });

        // Create animations for each timeline item
        items.forEach(item => {
            gsap.timeline({
                scrollTrigger: {
                    trigger: item,
                    start: 'start 45%',
                    end: 'start 35%',
                    scrub: true,

                }
            })
            .to(item.querySelectorAll('.experience_timeline_right, .experience_timeline_date-text'), {
                opacity: 1,
            })
            .to(item.querySelector('.experience_timeline_circle'), {
                backgroundColor: '#000000',
            }, '<');
        });

        // Control visibility of progress elements
        const timelineComponent = document.querySelector('.experience_timeline_component');
        if (!timelineComponent) return;

        ScrollTrigger.create({
            trigger: timelineComponent,
            start: 'top 120%',
            end: 'bottom -20%',
            onEnter: () => gsap.to(progressElements, { opacity: 1, duration: 0.1 }),
            onLeave: () => gsap.to(progressElements, { opacity: 0, duration: 0.1 }),
            onEnterBack: () => gsap.to(progressElements, { opacity: 1, duration: 0.1 }),
            onLeaveBack: () => gsap.to(progressElements, { opacity: 0, duration: 0.1 })
        });
    }
};

// Initialize on page load
document.addEventListener('DOMContentLoaded', () => TimelineManager.init());

