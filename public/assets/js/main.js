/* =========================
   SHARED UTILITIES
========================= */

/* =========================
   HEADER + MOBILE MENU
========================= */

// Mobile menu and header logic is now handled in app.blade.php to avoid duplication and scope issues.


/* =========================
   cart
========================= */
 document.addEventListener('DOMContentLoaded', function() {
        const cartBtn = document.getElementById('cart-btn');
        const cartDropdown = document.getElementById('cart-dropdown');
        const cartClose = document.getElementById('cart-close');
        function openCart() {
            if (!cartDropdown) return;
            cartDropdown.classList.remove('translate-x-full');
            cartDropdown.classList.add('translate-x-0');
        }

        function closeCart() {
            if (!cartDropdown) return;
            cartDropdown.classList.remove('translate-x-0');
            cartDropdown.classList.add('translate-x-full');
        }
        if (cartBtn) {
            cartBtn.addEventListener('click', function(e) {
                e.preventDefault();
                openCart();
            });
        }

        if (cartClose) {
            cartClose.addEventListener('click', function() {
                closeCart();
            });
        }
        document.addEventListener('click', function(e) {
            if (cartDropdown && !cartDropdown.classList.contains('translate-x-full')) {
                if (!cartDropdown.contains(e.target) && !cartBtn.contains(e.target)) {
                    closeCart();
                }
            }
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeCart();
            }
        });
    });


/* =========================
   SIMPLE CAROUSEL (REUSABLE)
========================= */
function basicCarousel(containerId, interval = 4000) {
    const container = document.getElementById(containerId);
    if (!container) return;
    const items = [...container.children];
    let i = 0;
    items.forEach((el, idx) => el.classList.toggle('hidden', idx !== 0));
    setInterval(() => {
        items[i].classList.add('hidden');
        i = (i + 1) % items.length;
        items[i].classList.remove('hidden');
    }, interval);
}

basicCarousel('hero-slider', 5000);

/* =========================
   TABS
========================= */
document.querySelectorAll('[role="tab"]').forEach(tab => {
    tab.addEventListener('click', () => {
        document.querySelectorAll('[role="tabpanel"]').forEach(p => p.classList.add('hidden'));
        document.getElementById(tab.getAttribute('aria-controls')).classList.remove('hidden');
    });
});

/* =========================
    Banner slider
========================= */

document.addEventListener('DOMContentLoaded', () => {
    new Swiper('.hero-swiper', {
        loop: true,
        effect: 'fade',
        fadeEffect: { crossFade: true },
        speed: 1000,

        autoplay: {
            delay: 5000,
            disableOnInteraction: false
        },

        pagination: {
            el: '.swiper-pagination',
            clickable: true
        },

        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev'
        }
    });
});

/* =========================
Logos Slider swiper
========================= */
document.addEventListener('DOMContentLoaded', function () {
    const swiperEl = document.querySelector('.brands-swiper');

    if (!swiperEl) return;

    new Swiper('.brands-swiper', {
        loop: true,
        slidesPerView: 5,
        spaceBetween: 24,
        autoplay: {
            delay: 2000,
            disableOnInteraction: false
        },
        speed: 800,
        allowTouchMove: true,
        breakpoints: {
            1280: { slidesPerView: 5 },
            1024: { slidesPerView: 4 },
            768: { slidesPerView: 3 },
            480: { slidesPerView: 2 },
            320: { slidesPerView: 2 }
        }
    });
});

/* =========================
    Products Slider swiper
========================= */
document.addEventListener('DOMContentLoaded', function () {

    new Swiper('.products-swiper', {
        slidesPerView: 4,
        spaceBetween: 24,

        grid: {
            rows: 2,
            fill: 'row'
        },

        navigation: {
            nextEl: '.swiper-button-next-custom',
            prevEl: '.swiper-button-prev-custom'
        },

        speed: 600,
        grabCursor: true,

        breakpoints: {
            1280: { slidesPerView: 4, grid: { rows: 2 } },
            1024: { slidesPerView: 3, grid: { rows: 2 } },
            768: { slidesPerView: 2, grid: { rows: 2 } },
            480: { slidesPerView: 1, grid: { rows: 1 } },
            320: { slidesPerView: 1, grid: { rows: 1 } }
        }
    });

});

/* =========================
    Banner slider swiper
========================= */
document.addEventListener('DOMContentLoaded', function () {

    new Swiper('.subproducts-swiper', {
        slidesPerView: 4,
        spaceBetween: 24,

        navigation: {
            nextEl: '.swiper-button-next-sub',
            prevEl: '.swiper-button-prev-sub'
        },

        speed: 600,
        grabCursor: true,

        breakpoints: {
            1280: { slidesPerView: 4 },
            1024: { slidesPerView: 3 },
            768: { slidesPerView: 2 },
            480: { slidesPerView: 1 },
            320: { slidesPerView: 1 }
        }
    });

});


/* =========================
   GRID / LIST TOGGLE
========================= */
const gridBtn = document.getElementById('gridBtn');
const listBtn = document.getElementById('listBtn');
const grid = document.getElementById('productGrid');
const cards = document.querySelectorAll('.product-card');

if (gridBtn && grid && cards.length) {
    gridBtn.onclick = () => {
        grid.classList.remove('list-view');
        cards.forEach(c => c.classList.remove('list-view'));
    };
}

if (listBtn && grid && cards.length) {
    listBtn.onclick = () => {
        grid.classList.add('list-view');
        cards.forEach(c => c.classList.add('list-view'));
    };
}


/* =========================
    Banner slider
========================= */


/* =========================
    Banner slider
========================= */