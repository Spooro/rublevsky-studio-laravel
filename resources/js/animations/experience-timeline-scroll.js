import gsap from 'gsap';
import ScrollTrigger from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

document.addEventListener('DOMContentLoaded', () => {
    const items = document.querySelectorAll('.experience_timeline_item');
    const progressElements = '.experience_timeline_progress, .experience_timeline_progress_bar';

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
    });

    // Control visibility of progress elements based on timeline component position
    const timelineComponent = document.querySelector('.experience_timeline_component');
    if (!timelineComponent) return;

    ScrollTrigger.create({
        trigger: timelineComponent,
        // Start showing 20% before the section enters viewport from bottom
        start: 'top 120%',
        // Hide 20% after the section leaves viewport from top
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
});

