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

    // Control visibility of progress elements based on scroll position
    ScrollTrigger.create({
        start: 0,
        end: 'max',
        onUpdate: (self) => {
            const progress = self.progress;
            const elements = document.querySelectorAll(progressElements);
            const opacity = (progress > 0.05 && progress < 0.95) ? 1 : 0;

            // Direct DOM manipulation for immediate effect
            elements.forEach(element => {
                element.style.opacity = opacity;
            });
        }
    });
});

