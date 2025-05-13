// console.log('main test!!!');

// Галерея и лайтбоксы от Fancybox
// import { Fancybox } from '@fancyapps/ui';
// import '@fancyapps/ui/dist/fancybox/fancybox.css';

// Fancybox.bind('[data-fancybox]', {
// 	// Your custom options
// });

// Мобильная навигация
import mobileNav from './modules/mobile-nav.js';
mobileNav();


/* Night mode */
const darkModeBtns = document.querySelectorAll(".toggleDarkModeBtn");

darkModeBtns.forEach((btn) => btn.addEventListener('click', toggleDarkMode));



function toggleDarkMode(e) {
    const darkMode = document.body.classList.toggle("dark");

    if (darkMode) {
        e.target.innerText = "☀️";
    } else {
        e.target.innerText = "🌘";
    }
}

// Scroll Reveal
// import scrollRevealFunc from './modules/scroll-reveal.js'
// scrollRevealFunc();

// Swiper Slider
// import swiper from './modules/swiper.js';
// swiper();


