import './bootstrap';
import navbar from './navbar.js';
import footer from './footer.js';

document.getElementById('navbar').innerHTML = navbar;

const footerContainer = document.getElementById('footer');
if (footerContainer) {
    footerContainer.innerHTML = footer;
}