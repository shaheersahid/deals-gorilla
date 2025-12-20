<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>{{ $title ?? 'Deals Gorilla' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/css/auth.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style_ui.css') }}">
    <!-- swiper CSS -->
    <link rel="stylesheet"  href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />




</head>

<body class="antialiased text-gray-700  bg-white overflow-x-hidden">

    @include('layouts.header')
    @yield('content')
    @include('layouts.footer')

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <!-- swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>





 <!--New Products Slider-->
    <script>
        (function() {
            const saleEnds = new Date(Date.now() + 3 * 24 * 60 * 60 * 1000).getTime();

            function pad(v) {
                return String(v).padStart(2, '0');
            }

            function updateCountdown() {
                const now = Date.now();
                let diff = Math.max(0, saleEnds - now);

                const days = Math.floor(diff / (24 * 60 * 60 * 1000));
                diff -= days * (24 * 60 * 60 * 1000);
                const hours = Math.floor(diff / (60 * 60 * 1000));
                diff -= hours * (60 * 60 * 1000);
                const mins = Math.floor(diff / (60 * 1000));
                diff -= mins * (60 * 1000);
                const secs = Math.floor(diff / 1000);

                document.getElementById('cd-days').textContent = pad(days);
                document.getElementById('cd-hours').textContent = pad(hours);
                document.getElementById('cd-mins').textContent = pad(mins);
                document.getElementById('cd-secs').textContent = pad(secs);
            }


            updateCountdown();
            setInterval(updateCountdown, 1000);

            const track = document.getElementById('flash-track');
            const prev = document.getElementById('flash-prev');
            const next = document.getElementById('flash-next');

            function scrollAmount(dir = 1) {
                const card = track.querySelector('article');
                if (!card) return 300;
                const style = getComputedStyle(track);
                const gap = parseFloat(style.gap) || 16;
                return (card.getBoundingClientRect().width + gap) * (dir);
            }

            prev.addEventListener('click', () => {
                track.scrollBy({
                    left: -scrollAmount(1),
                    behavior: 'smooth'
                });
            });
            next.addEventListener('click', () => {
                track.scrollBy({
                    left: scrollAmount(1),
                    behavior: 'smooth'
                });
            });

            // optional: support keyboard arrows when track focused
            track.setAttribute('tabindex', '0');
            track.addEventListener('keydown', (e) => {
                if (e.key === 'ArrowLeft') track.scrollBy({
                    left: -scrollAmount(1),
                    behavior: 'smooth'
                });
                if (e.key === 'ArrowRight') track.scrollBy({
                    left: scrollAmount(1),
                    behavior: 'smooth'
                });
            });
        })();
    </script>



    <!--Products Slider-->
    <script>
        (function() {
            const MAIN_IMG_ID = 'product-main-img';
            const THUMBS_CONTAINER_ID = 'product-thumbs';
            const THUMB_CLASS = 'thumb';
            const PREV_ID = 'imgPrev';
            const NEXT_ID = 'imgNext';
            const THUMB_UP_ID = 'thumbUp';
            const THUMB_DOWN_ID = 'thumbDown';
            const FALLBACK = 'https://via.placeholder.com/1200x900?text=image+not+found';

            const mainImg = document.getElementById(MAIN_IMG_ID);
            const thumbsContainer = document.getElementById(THUMBS_CONTAINER_ID);
            const prevBtn = document.getElementById(PREV_ID);
            const nextBtn = document.getElementById(NEXT_ID);
            const upBtn = document.getElementById(THUMB_UP_ID);
            const downBtn = document.getElementById(THUMB_DOWN_ID);

            if (!mainImg || !thumbsContainer) {
                console.error('[Slider] Missing mainImg or thumbsContainer.');
                return;
            }

            const thumbEls = Array.from(thumbsContainer.querySelectorAll('.' + THUMB_CLASS));
            if (thumbEls.length === 0) {
                console.error('[Slider] No .thumb elements found.');
                return;
            }

            const images = thumbEls.map((el) => (el.dataset.large || el.getAttribute('data-large') || (el.querySelector('img') && el.querySelector('img').src) || '')).filter(Boolean);
            mainImg.onerror = function() {
                if (!mainImg.dataset._errored) {
                    mainImg.dataset._errored = '1';
                    console.warn('[Slider] main image failed to load:', mainImg.src, '— switching to fallback.');
                    mainImg.src = FALLBACK;
                }
            };

            thumbEls.forEach((el, idx) => {
                if (!el.hasAttribute('data-index')) el.dataset.index = idx;
            });

            let current = 0;

            function checkImage(url, cb) {
                const i = new Image();
                i.onload = () => cb(true);
                i.onerror = () => cb(false);
                i.src = url;
            }

            function setActive(index, opts = {
                scrollThumb: true
            }) {
                if (index < 0) index = images.length - 1;
                if (index >= images.length) index = 0;
                current = index;
                const url = images[index];
                if (!url) {
                    mainImg.src = FALLBACK;
                    return;
                }
                checkImage(url, (ok) => {
                    if (ok) {
                        mainImg.src = url;
                    } else {
                        console.warn('[Slider] image not loadable:', url);
                        mainImg.src = FALLBACK;
                    }
                });

                thumbEls.forEach((el, i) => el.classList.toggle('active', i === index));
                if (opts.scrollThumb) {
                    const activeThumb = thumbEls[index];
                    if (activeThumb) activeThumb.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });
                }
            }

            thumbEls.forEach((t) => {
                t.addEventListener('click', () => {
                    const idx = Number(t.dataset.index);
                    if (!Number.isNaN(idx)) setActive(idx);
                });
            });

            if (prevBtn) prevBtn.addEventListener('click', () => setActive((current - 1 + images.length) % images.length));
            if (nextBtn) nextBtn.addEventListener('click', () => setActive((current + 1) % images.length));

            function scrollThumbs(dir) {
                if (!thumbsContainer) return;
                const firstThumb = thumbEls[0];
                if (!firstThumb) return;

                const itemHeight = firstThumb.offsetHeight || 64;

                const visibleCount = Math.max(1, Math.floor(thumbsContainer.clientHeight / itemHeight));
                const scrollAmount = itemHeight * visibleCount;

                thumbsContainer.scrollBy({
                    top: scrollAmount * dir,
                    behavior: 'smooth'
                });
            }

            if (upBtn) upBtn.addEventListener('click', () => scrollThumbs(-1));
            if (downBtn) downBtn.addEventListener('click', () => scrollThumbs(1));

            // allow arrow keys when thumbs container focused
            thumbsContainer.addEventListener('keydown', (e) => {
                if (e.key === 'ArrowUp') {
                    e.preventDefault();
                    scrollThumbs(-1);
                }
                if (e.key === 'ArrowDown') {
                    e.preventDefault();
                    scrollThumbs(1);
                }
            });

            // keyboard navigation for main image
            document.addEventListener('keydown', (e) => {
                if (e.key === 'ArrowLeft') setActive((current - 1 + images.length) % images.length);
                if (e.key === 'ArrowRight') setActive((current + 1) % images.length);
            });
            (function() {
                let startX = 0,
                    startY = 0;
                mainImg.addEventListener('touchstart', (ev) => {
                    startX = ev.touches[0].clientX;
                    startY = ev.touches[0].clientY;
                }, {
                    passive: true
                });
                mainImg.addEventListener('touchend', (ev) => {
                    const dx = ev.changedTouches[0].clientX - startX;
                    const dy = ev.changedTouches[0].clientY - startY;
                    if (Math.abs(dx) > 40 && Math.abs(dx) > Math.abs(dy)) {
                        if (dx < 0) setActive((current + 1) % images.length);
                        else setActive((current - 1 + images.length) % images.length);
                    }
                }, {
                    passive: true
                });
            })();

            (function init() {
                let i = 0;

                function tryNext() {
                    if (i >= images.length) {
                        mainImg.src = FALLBACK;
                        console.warn('[Slider] no valid images found; using fallback.');
                        return;
                    }
                    const url = images[i++];
                    checkImage(url, (ok) => {
                        if (ok) setActive(i - 1, {
                            scrollThumb: false
                        });
                        else tryNext();
                    });
                }
                tryNext();
            })();
            const dec = document.getElementById('decQty'),
                inc = document.getElementById('incQty'),
                qty = document.getElementById('qty');
            if (dec && inc && qty) {
                dec.addEventListener('click', () => {
                    qty.value = Math.max(1, Number(qty.value || 1) - 1);
                });
                inc.addEventListener('click', () => {
                    qty.value = Math.max(1, Number(qty.value || 1) + 1);
                });
            }

            window.productSlider = {
                images,
                setActive
            };
            console.info('[Slider] ready — images:', images.length);
        })();
    </script>
    <!-- Tabs Description -->
    <script>
        (function() {
            const tabs = Array.from(document.querySelectorAll('[role="tab"]'));
            const panels = Array.from(document.querySelectorAll('[role="tabpanel"]'));

            function activateTab(tab) {
                tabs.forEach(t => {
                    const selected = t === tab;
                    t.setAttribute('aria-selected', selected ? 'true' : 'false');
                    if (selected) {
                        t.classList.add('tab-active', 'text-gray-900');
                        t.classList.remove('text-gray-500');
                    } else {
                        t.classList.remove('tab-active', 'text-gray-900');
                        t.classList.add('text-gray-500');
                    }
                });
                panels.forEach(p => {
                    p.classList.toggle('hidden', p.id !== tab.getAttribute('aria-controls'));
                });
            }
            const defaultTab = document.getElementById('tab-details');
            activateTab(defaultTab);

            tabs.forEach(tab => {
                tab.addEventListener('click', () => activateTab(tab));

                tab.addEventListener('keydown', (e) => {
                    const idx = tabs.indexOf(tab);
                    if (e.key === 'ArrowRight') {
                        const next = tabs[(idx + 1) % tabs.length];
                        next.focus();
                        activateTab(next);
                    } else if (e.key === 'ArrowLeft') {
                        const prev = tabs[(idx - 1 + tabs.length) % tabs.length];
                        prev.focus();
                        activateTab(prev);
                    }
                });
            });
        })();
    </script>
    <!-- Star Reating -->
    <script>
        document.getElementById('seeMoreBtn').addEventListener('click', function() {
            const container = document.querySelector('.md\\:col-span-2 .space-y-6');
            if (!container) return;
            const first = container.querySelector('article');
            if (first) {
                const clone = first.cloneNode(true);
                container.appendChild(clone);
                clone.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
            }
        });
    </script>
    <!-- Star Cart -->
    <script>
        const mobileBtn = document.getElementById('mobileFiltersBtn');
        const mobileFilters = document.getElementById('mobileFilters');
        const mobileClose = document.getElementById('mobileFiltersClose');
        const mobileBackdrop = document.getElementById('mobileFiltersBackdrop');

        function openMobileFilters() {
            mobileFilters.classList.remove('hidden');
        }

        function closeMobileFilters() {
            mobileFilters.classList.add('hidden');
        }
        if (mobileBtn) mobileBtn.addEventListener('click', openMobileFilters);
        if (mobileClose) mobileClose.addEventListener('click', closeMobileFilters);
        if (mobileBackdrop) mobileBackdrop.addEventListener('click', closeMobileFilters);
    </script>
    <!-- Minimal JS -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const header = document.getElementById('site-header');
            const mobileBtn = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');
            const openIcon = document.getElementById('hamburger-open');
            const closeIcon = document.getElementById('hamburger-close');
            const mobileClose = document.getElementById('mobile-close');
            const mobileOverlay = document.getElementById('mobile-overlay');
            const mobileSearchBtn = document.getElementById('mobile-search-btn');
            const mobileSearchFull = document.getElementById('mobile-search-full');
            const mobileSearchClose = document.getElementById('mobile-search-close');
            const mobileSearchInput = document.getElementById('mobile-search-input');

            const megaPanel = document.getElementById('mega-panel');
            const megaTrigger = document.getElementById('mega-trigger');
            const megaTriggerNav = document.getElementById('mega-trigger-nav');
            let scrollLockPosition = 0;

            function disableScroll() {
                scrollLockPosition = window.pageYOffset || document.documentElement.scrollTop || 0;
                document.documentElement.style.top = `-${scrollLockPosition}px`;
                document.documentElement.style.position = 'fixed';
                document.documentElement.style.width = '100%';
            }

            function enableScroll() {
                document.documentElement.style.position = '';
                document.documentElement.style.top = '';
                document.documentElement.style.width = '';
                window.scrollTo(0, scrollLockPosition);
            }

            function openMobileMenu() {
                if (mobileSearchFull && !mobileSearchFull.classList.contains('hidden')) closeMobileSearch();
                if (mobileOverlay) {
                    mobileOverlay.classList.remove('opacity-0', 'pointer-events-none');
                    mobileOverlay.classList.add('opacity-100');
                }
                if (mobileMenu) {
                    mobileMenu.classList.remove('-translate-x-full');
                    mobileMenu.classList.add('translate-x-0');
                }
                openIcon && openIcon.classList.add('hidden');
                closeIcon && closeIcon.classList.remove('hidden');
                disableScroll();
            }

            function closeMobileMenu() {
                if (mobileOverlay) {
                    mobileOverlay.classList.add('opacity-0', 'pointer-events-none');
                    mobileOverlay.classList.remove('opacity-100');
                }
                if (mobileMenu) {
                    mobileMenu.classList.remove('translate-x-0');
                    mobileMenu.classList.add('-translate-x-full');
                }
                openIcon && openIcon.classList.remove('hidden');
                closeIcon && closeIcon.classList.add('hidden');
                enableScroll();
                document.querySelectorAll('.accordion-panel').forEach(p => p.classList.add('hidden'));
            }

            if (mobileBtn) {
                mobileBtn.addEventListener('click', (e) => {
                    // Force ensure menu is visible (remove hidden if present)
                    if (mobileMenu.classList.contains('hidden')) {
                        mobileMenu.classList.remove('hidden');
                    }
                    
                    const isClosed = mobileMenu.classList.contains('-translate-x-full');
                    if (isClosed) {
                        openMobileMenu();
                    } else {
                        closeMobileMenu();
                    }
                });
            }
            if (mobileClose) mobileClose.addEventListener('click', closeMobileMenu);
            if (mobileOverlay) mobileOverlay.addEventListener('click', closeMobileMenu);

            /* Mobile fullscreen search  */
            function openMobileSearch() {
                if (mobileMenu && !mobileMenu.classList.contains('-translate-x-full')) closeMobileMenu();
                if (mobileSearchFull) {
                    mobileSearchFull.classList.remove('hidden');
                    setTimeout(() => mobileSearchFull.classList.add('opacity-100'), 10);
                    disableScroll();
                    setTimeout(() => {
                        if (mobileSearchInput) mobileSearchInput.focus();
                    }, 120);
                }
            }

            function closeMobileSearch() {
                if (!mobileSearchFull) return;
                mobileSearchFull.classList.remove('opacity-100');
                setTimeout(() => mobileSearchFull.classList.add('hidden'), 200);
                enableScroll();
            }
            if (mobileSearchBtn) mobileSearchBtn.addEventListener('click', (e) => {
                e.preventDefault();
                openMobileSearch();
            });
            if (mobileSearchClose) mobileSearchClose.addEventListener('click', (e) => {
                e.preventDefault();
                closeMobileSearch();
            });
            if (mobileSearchFull) {
                mobileSearchFull.addEventListener('click', (e) => {
                    if (e.target === mobileSearchFull) closeMobileSearch();
                });
            }

            function positionMegaPanelFixed() {
                const nav = document.getElementById('site-nav');
                if (!nav || !megaPanel || !megaTriggerNav) return;
                const headerRect = header.getBoundingClientRect();
                const navRect = nav.getBoundingClientRect();
                const triggerRect = megaTriggerNav.getBoundingClientRect();
                const gap = 8; 
                const top = navRect.bottom + gap;
                let left = Math.max(8, triggerRect.left);
                const margin = 12;
                const maxW = Math.min(1215, window.innerWidth - left - margin);
                megaPanel.style.top = `${top}px`;
                megaPanel.style.left = `${left}px`;
                megaPanel.style.width = `${maxW}px`;
            }

            function showMega() {
                positionMegaPanelFixed();
                megaPanel.classList.remove('opacity-0', 'pointer-events-none');
                megaPanel.classList.add('opacity-100', 'pointer-events-auto', 'open');
                megaPanel.setAttribute('aria-hidden', 'false');
                megaTrigger?.setAttribute('aria-expanded', 'true');
            }

            function hideMega() {
                megaPanel.classList.remove('opacity-100', 'pointer-events-auto', 'open');
                megaPanel.classList.add('opacity-0', 'pointer-events-none');
                megaPanel.setAttribute('aria-hidden', 'true');
                megaTrigger?.setAttribute('aria-expanded', 'false');
            }

            (function setupMega() {
                if (!megaTrigger || !megaPanel || !megaTriggerNav) return;
                let openTimer = null,
                    closeTimer = null;
                const OPEN_DELAY = 60,
                    CLOSE_DELAY = 220;
                megaTriggerNav.addEventListener('mouseenter', () => {
                    clearTimeout(closeTimer);
                    openTimer = setTimeout(showMega, OPEN_DELAY);
                });
                megaTriggerNav.addEventListener('mouseleave', () => {
                    clearTimeout(openTimer);
                    closeTimer = setTimeout(hideMega, CLOSE_DELAY);
                });
                megaPanel.addEventListener('mouseenter', () => clearTimeout(closeTimer));
                megaPanel.addEventListener('mouseleave', () => closeTimer = setTimeout(hideMega, CLOSE_DELAY));
                megaTrigger.addEventListener('click', (e) => {
                    e.preventDefault();
                    if (megaPanel.classList.contains('open')) hideMega();
                    else showMega();
                });
                window.addEventListener('resize', positionMegaPanelFixed);
                window.addEventListener('scroll', positionMegaPanelFixed, {
                    passive: true
                });
                positionMegaPanelFixed();
            })();

            document.querySelectorAll('.accordion-btn').forEach(btn => {
                btn.addEventListener('click', () => {
                    const panel = btn.nextElementSibling;
                    const isHidden = panel.classList.contains('hidden');
                    document.querySelectorAll('.accordion-panel').forEach(p => p.classList.add('hidden'));
                    if (isHidden) panel.classList.remove('hidden');
                });
            });

            (function setupHeaderScrollToggle() {
                if (!header) return;
                let lastScrollY = window.pageYOffset || 0;
                let ticking = false;
                const HIDE_AFTER = 80;

                function onScroll() {
                    const current = window.pageYOffset || 0;
                    if (current > lastScrollY && current > HIDE_AFTER) {
                        header.classList.add('hidden-up');
                        header.classList.remove('visible');
                    } else {
                        header.classList.remove('hidden-up');
                        header.classList.add('visible');
                    }
                    if (current === 0) {
                        header.classList.remove('hidden-up');
                        header.classList.add('visible');
                    }
                    lastScrollY = current <= 0 ? 0 : current;
                    ticking = false;
                }
                window.addEventListener('scroll', () => {
                    if (!ticking) {
                        window.requestAnimationFrame(onScroll);
                        ticking = true;
                    }
                }, {
                    passive: true
                });
                header.classList.add('visible');
            })();

            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') {
                    if (mobileSearchFull && !mobileSearchFull.classList.contains('hidden')) closeMobileSearch();
                    else if (mobileMenu && !mobileMenu.classList.contains('-translate-x-full')) closeMobileMenu();
                    else if (megaPanel && megaPanel.classList.contains('open')) hideMega();
                }
            });

            (function setupResizeWatcher() {
                const mq = window.matchMedia('(min-width: 768px)');

                function handleResize(e) {
                    if (e.matches) {
                        if (mobileMenu && !mobileMenu.classList.contains('-translate-x-full')) closeMobileMenu();
                        if (mobileSearchFull && !mobileSearchFull.classList.contains('hidden')) closeMobileSearch();
                    }
                    positionMegaPanelFixed();
                }
                mq.addEventListener ? mq.addEventListener('change', handleResize) : mq.addListener(handleResize);
                handleResize(mq);
            })();

        });
    </script>
</body>

</html>