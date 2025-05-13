//(()=>{"use strict";function e(e){const t=document.body.classList.toggle("dark");e.target.innerText=t?"☀️":"🌘"}!function(){const e=document.querySelector(".mobile-nav-btn"),t=document.querySelector(".mobile-nav"),o=document.querySelector(".mobile-nav-btn__icon"),c=document.querySelector(".mobile-nav-fade");function n(){t.classList.toggle("active"),e.classList.toggle("active"),o.classList.toggle("active"),document.body.classList.toggle("no-scroll"),c.classList.toggle("mobile-nav-fade--open")}e.onclick=n,c.onclick=n}(),document.querySelectorAll(".toggleDarkModeBtn").forEach((t=>t.addEventListener("click",e)))})();
//# sourceMappingURL=index.bundle.js.map
/* ================  Mobile navigation  ============================ */
function mobileNav() {
    const navBtn = document.querySelector(".mobile-nav-btn");
    // const closeBtn = document.querySelector(".mobile-close-btn");
    const nav = document.querySelector(".mobile-nav");
    const menuIcon = document.querySelector(".mobile-nav-btn__icon");

    const fade = document.querySelector(".mobile-nav-fade");

    navBtn.onclick = toggleMobile;
    // closeBtn.onclick = toggleMobile;
    fade.onclick = toggleMobile;

    function toggleMobile() {
        // nav.classList.toggle("mobile-nav");  // Если используем одно меню nav/mobile-nav
        nav.classList.toggle("active");
        navBtn.classList.toggle("active");
        menuIcon.classList.toggle("active");
        document.body.classList.toggle("no-scroll");
        fade.classList.toggle("mobile-nav-fade--open");
    }
}

mobileNav();