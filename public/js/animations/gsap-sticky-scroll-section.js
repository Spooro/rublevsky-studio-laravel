document.addEventListener("DOMContentLoaded", () => {
    gsap.registerPlugin(ScrollTrigger);

    // Get all sections
    const sections = document.querySelectorAll('section');

    sections.forEach((section, index) => {
        // Get the actual height of the section
        const sectionHeight = section.offsetHeight;
        const viewportHeight = window.innerHeight;

        // Only apply sticky scroll effect if section is taller than viewport
        if (sectionHeight > viewportHeight) {
            // Create a wrapper div for the sticky content
            const wrapper = document.createElement('div');
            wrapper.style.height = `${sectionHeight}px`; // Set wrapper height to section height
            section.parentNode.insertBefore(wrapper, section);
            wrapper.appendChild(section);

            // Make the section sticky
            gsap.set(section, {
                position: 'sticky',
                top: 0,
                height: '100vh',
                overflow: 'hidden'
            });

            // Get the content container inside the section
            const content = section.querySelector(':scope > div');
            if (content) {
                // Calculate the scroll progress
                gsap.to(content, {
                    y: -(sectionHeight - viewportHeight),
                    ease: "none",
                    scrollTrigger: {
                        trigger: wrapper,
                        start: "top top",
                        end: "bottom bottom",
                        scrub: true,
                        pin: false,
                        // markers: true, // Uncomment for debugging
                    }
                });
            }
        } else {
            // For sections shorter than viewport height, use the original animation
            const tl = gsap.timeline({
                scrollTrigger: {
                    trigger: section,
                    start: "top center",
                    end: "bottom center",
                    toggleActions: "play reverse play reverse",
                }
            });

            gsap.set(section, {
                opacity: 0,
                y: 50,
            });

            tl.to(section, {
                opacity: 1,
                y: 0,
                duration: 1,
                ease: "power2.out"
            });
        }
    });
});
