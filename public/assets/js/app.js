(function ($) {
    'use strict';

    /* ===============================
       HELPERS
    =============================== */
    const $w = $(window);
    const $d = $(document);
    let scrollLockY = 0;

    function lockScroll() {
        scrollLockY = $w.scrollTop();
        $('html').css({ position: 'fixed', top: -scrollLockY, width: '100%' });
    }

    function unlockScroll() {
        $('html').css({ position: '', top: '', width: '' });
        $w.scrollTop(scrollLockY);
    }

    function debounceRAF(fn) {
        let ticking = false;
        return function () {
            if (!ticking) {
                requestAnimationFrame(() => {
                    fn();
                    ticking = false;
                });
                ticking = true;
            }
        };
    }

    /* ===============================
       COUNTDOWN
    =============================== */
    (function countdown() {
        const end = Date.now() + 3 * 24 * 60 * 60 * 1000;

        function pad(v) { return String(v).padStart(2, '0'); }

        function update() {
            let diff = Math.max(0, end - Date.now());
            const d = Math.floor(diff / 86400000); diff %= 86400000;
            const h = Math.floor(diff / 3600000); diff %= 3600000;
            const m = Math.floor(diff / 60000);
            const s = Math.floor((diff % 60000) / 1000);

            $('#cd-days').text(pad(d));
            $('#cd-hours').text(pad(h));
            $('#cd-mins').text(pad(m));
            $('#cd-secs').text(pad(s));
        }

        update();
        setInterval(update, 1000);
    })();

    /* ===============================
       FLASH SCROLLER
    =============================== */
    (function () {
        const $track = $('#flash-track');
        const $prev = $('#flash-prev');
        const $next = $('#flash-next');

        if (!$track.length) return;

        function scrollByDir(dir) {
            const card = $track.find('article').first();
            if (!card.length) return;
            const gap = parseFloat(getComputedStyle($track[0]).gap) || 16;
            $track.scrollLeft($track.scrollLeft() + (card.outerWidth() + gap) * dir);
        }

        $prev.on('click', () => scrollByDir(-1));
        $next.on('click', () => scrollByDir(1));

        $track.attr('tabindex', 0).on('keydown', e => {
            if (e.key === 'ArrowLeft') scrollByDir(-1);
            if (e.key === 'ArrowRight') scrollByDir(1);
        });
    })();

    /* ===============================
       PRODUCT IMAGE SLIDER
    =============================== */
    (function () {
        const $main = $('#product-main-img');
        const $thumbs = $('#product-thumbs');
        if (!$main.length || !$thumbs.length) return;

        const FALLBACK = 'https://via.placeholder.com/1200x900?text=image+not+found';
        const $thumbEls = $thumbs.find('.thumb');
        const images = $thumbEls.map((i, el) =>
            $(el).data('large') || $(el).find('img').attr('src')
        ).get();

        let current = 0;

        function loadImage(src, cb) {
            const img = new Image();
            img.onload = () => cb(true);
            img.onerror = () => cb(false);
            img.src = src;
        }

        function setActive(i, scroll = true) {
            if (!images[i]) return;
            current = i;

            loadImage(images[i], ok => {
                $main.attr('src', ok ? images[i] : FALLBACK);
            });

            $thumbEls.removeClass('active').eq(i).addClass('active');

            if (scroll) {
                $thumbEls.eq(i)[0].scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        }

        $thumbEls.each((i, el) => {
            $(el).on('click', () => setActive(i));
        });

        $('#imgPrev').on('click', () => setActive((current - 1 + images.length) % images.length));
        $('#imgNext').on('click', () => setActive((current + 1) % images.length));

        $d.on('keydown', e => {
            if (e.key === 'ArrowLeft') setActive((current - 1 + images.length) % images.length);
            if (e.key === 'ArrowRight') setActive((current + 1) % images.length);
        });

        setActive(0, false);
    })();

    /* ===============================
       MOBILE MENU
    =============================== */
    const $mobileMenu = $('#mobile-menu');
    const $mobileBtn = $('#mobile-menu-button');
    const $mobileClose = $('#mobile-close');
    const $overlay = $('#mobile-overlay');

    function openMenu() {
        $mobileMenu.removeClass('-translate-x-full');
        $overlay.removeClass('opacity-0 pointer-events-none');
        lockScroll();
    }

    function closeMenu() {
        $mobileMenu.addClass('-translate-x-full');
        $overlay.addClass('opacity-0 pointer-events-none');
        unlockScroll();
    }

    $mobileBtn.on('click', () =>
        $mobileMenu.hasClass('-translate-x-full') ? openMenu() : closeMenu()
    );
    $mobileClose.on('click', closeMenu);
    $overlay.on('click', closeMenu);

    /* ===============================
       MEGA MENU
    =============================== */
    (function () {
        const $panel = $('#mega-panel');
        const $trigger = $('#mega-trigger');
        const $nav = $('#mega-trigger-nav');

        if (!$panel.length) return;

        let isOpen = false;
        let closeTimeout;


        function position() {
            const nav = document.querySelector('#site-nav');

            const navRect = nav.getBoundingClientRect();
            const panelWidth = Math.min(1215, navRect.width);

            const left = navRect.left + (navRect.width - panelWidth) / 2;

            $panel.css({
                top: navRect.bottom + 8,
                left: left,
                width: panelWidth
            });
        }


        function open() {
            clearTimeout(closeTimeout);
            position();
            $panel
                .addClass('open opacity-100')
                .removeClass('opacity-0 pointer-events-none');
            isOpen = true;
        }

        function close() {
            closeTimeout = setTimeout(() => {
                $panel
                    .addClass('opacity-0 pointer-events-none')
                    .removeClass('open');
                isOpen = false;
            }, 150);
        }

        // OPEN on hover
        $trigger.on('mouseenter', open);
        $nav.on('mouseenter', open);

        // CLOSE only when leaving both trigger & panel
        $trigger.on('mouseleave', close);
        $panel.on('mouseleave', close);

        // Prevent close when hovering panel
        $panel.on('mouseenter', () => clearTimeout(closeTimeout));

        // Click toggle (optional for mobile)
        $trigger.on('click', e => {
            e.preventDefault();
            isOpen ? close() : open();
        });

        $w.on('resize scroll', position);
    })();

    /* ===============================
       TABS
    =============================== */
    (function () {
        const $tabs = $('[role="tab"]');
        const $panels = $('[role="tabpanel"]');

        function activate($tab) {
            $tabs.attr('aria-selected', false)
                .removeClass('tab-active text-gray-900')
                .addClass('text-gray-500');

            $tab.attr('aria-selected', true)
                .addClass('tab-active text-gray-900')
                .removeClass('text-gray-500');

            $panels.addClass('hidden')
                .filter('#' + $tab.attr('aria-controls'))
                .removeClass('hidden');
        }

        activate($('#tab-details'));

        $tabs.on('click', function () {
            activate($(this));
        });
    })();

    /* ===============================
       HEADER SCROLL
    =============================== */
    (function () {
        let last = 0;
        $w.on('scroll', debounceRAF(() => {
            const y = $w.scrollTop();
            const $h = $('#site-header');

            if (y > last && y > 80) $h.addClass('hidden-up').removeClass('visible');
            else $h.addClass('visible').removeClass('hidden-up');

            last = y;
        }));
    })();

})(jQuery);
