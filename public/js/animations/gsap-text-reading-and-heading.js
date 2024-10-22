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
        const headings = document.querySelectorAll('h1');
        headings.forEach(heading => {
            gsap.fromTo(heading, {
                y: 50,
                opacity: 0
            }, {
                y: 0,
                opacity: 1,
                duration: 0.5,
                delay: 0.3, // Added delay of 0.3 seconds
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

    function imageGallery(type, images) {
        return {
            type,
            images,
            isOpen: false,
            currentIndex: 0,
            getImageUrl(image) {
                return `{{ Storage::disk('r2')->url('') }}${image}`;
            },
            get currentImage() {
                return this.getImageUrl(this.images[this.currentIndex]);
            },
            openGallery(index) {
                this.currentIndex = index;
                this.isOpen = true;
            },
            closeGallery() {
                this.isOpen = false;
            },
            nextImage() {
                this.currentIndex = (this.currentIndex + 1) % this.images.length;
            },
            prevImage() {
                this.currentIndex = (this.currentIndex - 1 + this.images.length) % this.images.length;
            }
        }
    }

