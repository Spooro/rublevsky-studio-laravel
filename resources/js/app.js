import './bootstrap';

import '../css/app.css';

import Alpine from 'alpinejs'
import anchor from '@alpinejs/anchor'
import { productGallery, getImageUrl } from './components/gallery'

// Import scroll progress
import './scroll-progress.js';

Alpine.plugin(anchor)

// Make gallery functions globally available
window.productGallery = productGallery;
window.getImageUrl = getImageUrl;
