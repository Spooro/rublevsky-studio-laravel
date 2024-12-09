import gsap from 'gsap';
import ScrollTrigger from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

document.addEventListener('DOMContentLoaded', () => {
    const items = document.querySelectorAll('.experience_timeline_item');

    // Set initial states
    gsap.set('.experience_timeline_right, .experience_timeline_date-text', {
        opacity: 0.20
    });
    gsap.set('.experience_timeline_circle', {
        backgroundColor: '#e5e5e5'
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
        }, '<'); // The '<' makes this animation start at the same time as the previous one
    });
});

