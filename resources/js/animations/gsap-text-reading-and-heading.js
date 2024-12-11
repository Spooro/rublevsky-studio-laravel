document.addEventListener('DOMContentLoaded', initializeAnimations);
    document.addEventListener('livewire:navigated', initializeAnimations);

    function initializeAnimations() {
        gsap.registerPlugin(ScrollTrigger);
        animateHeadings();
        document.querySelectorAll('[reveal-type]').forEach(animateRevealTypeByLetters);
        hideHeadingElements();
    }

    function animateRevealTypeByLetters(element) {
        const text = new SplitType(element, {
            types: ['words']
        });
        gsap.from(text.words, {
            scrollTrigger: {
                trigger: element,
                start: 'top 50%',
                end: 'top 30%',
                scrub: true,
                markers: false
            },
            opacity: 0.2,
            stagger: 0.1,
        });
    }

    function animateHeadings() {
        const headings = document.querySelectorAll('[heading-reveal]');
        headings.forEach(heading => {
            gsap.fromTo(heading, {
                y: 50,
                opacity: 0
            }, {
                y: 0,
                opacity: 1,
                duration: 1,
                //delay: 0.2,
                ease: "power2.out",
                scrollTrigger: {
                    trigger: heading,
                    start: "top 80%",
                    once: true
                }
            });
        });
    }

    function hideHeadingElements() {
        const headingElements = document.querySelectorAll('[heading-hide]');
        headingElements.forEach(element => {
            gsap.fromTo(element, {
                opacity: 1
            }, {
                opacity: 0,
                scrollTrigger: {
                    trigger: element,
                    start: 'top 15%',
                    end: 'top 5%',
                    scrub: true,
                    markers: false
                }
            });
        });
    }
