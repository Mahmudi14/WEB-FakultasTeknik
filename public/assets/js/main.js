/**
 * Template Name: iLanding
 * Template URL: https://bootstrapmade.com/ilanding-bootstrap-landing-page-template/
 * Updated: Nov 12 2024 with Bootstrap v5.3.3
 * Author: BootstrapMade.com
 * License: https://bootstrapmade.com/license/
 */

(function () {
    "use strict";

    /**
     * Apply .scrolled class to the body as the page is scrolled down
     */
    function toggleScrolled() {
        const selectBody = document.querySelector("body");
        const selectHeader = document.querySelector("#header");
        if (
            !selectHeader.classList.contains("scroll-up-sticky") &&
            !selectHeader.classList.contains("sticky-top") &&
            !selectHeader.classList.contains("fixed-top")
        )
            return;
        window.scrollY > 100
            ? selectBody.classList.add("scrolled")
            : selectBody.classList.remove("scrolled");
    }

    document.addEventListener("scroll", toggleScrolled);
    window.addEventListener("load", toggleScrolled);

    /**
     * Mobile nav toggle
     */
    const mobileNavToggleBtn = document.querySelector(".mobile-nav-toggle");

    function mobileNavToogle() {
        document.querySelector("body").classList.toggle("mobile-nav-active");
        mobileNavToggleBtn.classList.toggle("bi-list");
        mobileNavToggleBtn.classList.toggle("bi-x");
    }
    if (mobileNavToggleBtn) {
        mobileNavToggleBtn.addEventListener("click", mobileNavToogle);
    }

    /**
     * Hide mobile nav on same-page/hash links
     */
    document.querySelectorAll("#navmenu a").forEach((navmenu) => {
        navmenu.addEventListener("click", () => {
            if (document.querySelector(".mobile-nav-active")) {
                mobileNavToogle();
            }
        });
    });

    /**
     * Toggle mobile nav dropdowns
     */
    document
        .querySelectorAll(".navmenu .toggle-dropdown")
        .forEach((navmenu) => {
            navmenu.addEventListener("click", function (e) {
                e.preventDefault();
                this.parentNode.classList.toggle("active");
                this.parentNode.nextElementSibling.classList.toggle(
                    "dropdown-active"
                );
                e.stopImmediatePropagation();
            });
        });

    /**
     * Scroll top button
     */
    let scrollTop = document.querySelector(".scroll-top");

    function toggleScrollTop() {
        if (scrollTop) {
            window.scrollY > 100
                ? scrollTop.classList.add("active")
                : scrollTop.classList.remove("active");
        }
    }
    scrollTop.addEventListener("click", (e) => {
        e.preventDefault();
        window.scrollTo({
            top: 0,
            behavior: "smooth",
        });
    });

    window.addEventListener("load", toggleScrollTop);
    document.addEventListener("scroll", toggleScrollTop);

    /**
     * Animation on scroll function and init
     */
    function aosInit() {
        AOS.init({
            duration: 600,
            easing: "ease-in-out",
            once: true,
            mirror: false,
        });
    }
    window.addEventListener("load", aosInit);

    /**
     * Initiate glightbox
     */
    const glightbox = GLightbox({
        selector: ".glightbox",
    });

    /**
     * Init swiper sliders
     */
    function initSwiper() {
        document
            .querySelectorAll(".init-swiper")
            .forEach(function (swiperElement) {
                let config = JSON.parse(
                    swiperElement
                        .querySelector(".swiper-config")
                        .innerHTML.trim()
                );

                if (swiperElement.classList.contains("swiper-tab")) {
                    initSwiperWithCustomPagination(swiperElement, config);
                } else {
                    new Swiper(swiperElement, config);
                }
            });
    }

    window.addEventListener("load", initSwiper);

    /**
     * Initiate Pure Counter
     */
    new PureCounter();

    /**
     * Frequently Asked Questions Toggle
     */
    document
        .querySelectorAll(".faq-item h3, .faq-item .faq-toggle")
        .forEach((faqItem) => {
            faqItem.addEventListener("click", () => {
                faqItem.parentNode.classList.toggle("faq-active");
            });
        });

    /**
     * Correct scrolling position upon page load for URLs containing hash links.
     */
    window.addEventListener("load", function (e) {
        if (window.location.hash) {
            if (document.querySelector(window.location.hash)) {
                setTimeout(() => {
                    let section = document.querySelector(window.location.hash);
                    let scrollMarginTop =
                        getComputedStyle(section).scrollMarginTop;
                    window.scrollTo({
                        top: section.offsetTop - parseInt(scrollMarginTop),
                        behavior: "smooth",
                    });
                }, 100);
            }
        }
    });

    /**
     * Navmenu Scrollspy
     */
    let navmenulinks = document.querySelectorAll(".navmenu a");

    function navmenuScrollspy() {
        navmenulinks.forEach((navmenulink) => {
            if (!navmenulink.hash) return;
            let section = document.querySelector(navmenulink.hash);
            if (!section) return;
            let position = window.scrollY + 200;
            if (
                position >= section.offsetTop &&
                position <= section.offsetTop + section.offsetHeight
            ) {
                document
                    .querySelectorAll(".navmenu a.active")
                    .forEach((link) => link.classList.remove("active"));
                navmenulink.classList.add("active");
            } else {
                navmenulink.classList.remove("active");
            }
        });
    }
    window.addEventListener("load", navmenuScrollspy);
    document.addEventListener("scroll", navmenuScrollspy);
})();

// Beasiswa Page
const progress = document.getElementById("progress");
const prev = document.getElementById("prev");
const next = document.getElementById("next");
const circles = document.querySelectorAll(".circle");
const steps = document.querySelectorAll(".step");

let currentActive = 0;

next.addEventListener("click", () => {
    currentActive++;

    if (currentActive > circles.length - 1) {
        currentActive = circles.length - 1;
    }

    update();
});

prev.addEventListener("click", () => {
    currentActive--;

    if (currentActive < 0) {
        currentActive = 0;
    }

    update();
});

function update() {
    circles.forEach((circle, idx) => {
        if (idx <= currentActive) {
            circle.classList.add("active");
        } else {
            circle.classList.remove("active");
        }
    });

    steps.forEach((step, idx) => {
        if (idx === currentActive) {
            step.classList.add("active");
        } else {
            step.classList.remove("active");
        }
    });

    const actives = document.querySelectorAll(".circle.active");

    progress.style.width =
        ((actives.length - 1) / (circles.length - 1)) * 100 + "%";

    if (currentActive === 0) {
        prev.disabled = true;
    } else if (currentActive === circles.length - 1) {
        next.disabled = true;
    } else {
        prev.disabled = false;
        next.disabled = false;
    }
}
