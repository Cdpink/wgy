import navbar from './navbar';
import footer from './footer';

// Inject navbar into the DOM
const navbarContainer = document.getElementById('navbar');
if (navbarContainer) {
  navbarContainer.innerHTML = navbar;
}

// Inject footer into the DOM
const footerContainer = document.getElementById('footer');
if (footerContainer) {
  footerContainer.innerHTML = footer;
}
