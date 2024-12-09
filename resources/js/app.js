import './bootstrap';

import '../css/app.css';
import '../css/typography.css'
import '../css/navbar.css'
import '../css/sliders.css'
import '../css/experience-timeline.css'
import '../css/services-offered.css'
import '../css/buttons.css'

import Alpine from 'alpinejs'
import anchor from '@alpinejs/anchor'
import { productGallery, getImageUrl } from './components/gallery'

// Import scroll progress
import './blog-percentage-scroll-progress.js';
import './animations/sliders.js';
import './animations/gsap-text-reading-and-heading.js';
import './animations/timeline-scroll.js';

Alpine.plugin(anchor)

// Make gallery functions globally available
window.productGallery = productGallery;
window.getImageUrl = getImageUrl;
