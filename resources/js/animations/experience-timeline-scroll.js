import gsap from 'gsap';
import ScrollTrigger from 'gsap/ScrollTrigger';

class TimelineManager {
    constructor() {
        this.initialized = false;
        this.scrollTriggers = [];
    }

    init() {
        gsap.registerPlugin(ScrollTrigger);
        this.initializeTimeline();
        this.bindEvents();
    }

    initializeTimeline() {
        // Clean up existing instances
        this.cleanup();

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
            const tl = gsap.timeline({
                scrollTrigger: {
                    trigger: item,
                    start: 'top 46%',
                    end: 'top 43%',
                    scrub: true,
                }
            });

            tl.to(item.querySelectorAll('.experience_timeline_right, .experience_timeline_date-text'), {
                opacity: 1,
            })
            .to(item.querySelector('.experience_timeline_circle'), {
                backgroundColor: '#000000',
            }, '<');

            // Store ScrollTrigger instance for cleanup
            this.scrollTriggers.push(tl.scrollTrigger);
        });

        // Control visibility of progress elements
        const timelineComponent = document.querySelector('.experience_timeline_component');
        if (!timelineComponent) return;

        const progressTrigger = ScrollTrigger.create({
            trigger: timelineComponent,
            start: 'top 120%',
            end: 'bottom -20%',
            onEnter: () => {
                gsap.to(progressElements, { opacity: 1, duration: 0.1 });
            },
            onLeave: () => {
                gsap.to(progressElements, { opacity: 0, duration: 0.1 });
            },
            onEnterBack: () => {
                gsap.to(progressElements, { opacity: 1, duration: 0.1 });
            },
            onLeaveBack: () => {
                gsap.to(progressElements, { opacity: 0, duration: 0.1 });
            }
        });

        this.scrollTriggers.push(progressTrigger);
    }

    cleanup() {
        // Clean up stored ScrollTrigger instances
        this.scrollTriggers.forEach(trigger => {
            if (trigger) trigger.kill();
        });
        this.scrollTriggers = [];
    }

    bindEvents() {
        if (this.initialized) return;

        document.addEventListener('livewire:navigated', () => {
            // Small delay to ensure DOM is ready
            setTimeout(() => this.initializeTimeline(), 50);
        });

        document.addEventListener('livewire:navigating', () => {
            this.cleanup();
        });

        this.initialized = true;
    }
}

// Create and initialize the manager
const timelineManager = new TimelineManager();
document.addEventListener('DOMContentLoaded', () => timelineManager.init());

