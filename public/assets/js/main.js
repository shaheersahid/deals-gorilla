document.addEventListener('DOMContentLoaded', function () {
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
        mobileBtn.addEventListener('click', () => {
            const closed = mobileMenu.classList.contains('-translate-x-full') || (!mobileMenu.classList.contains('translate-x-0'));
            if (closed) openMobileMenu();
            else closeMobileMenu();
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
        if (!header || !megaPanel || !megaTriggerNav) return;
        const headerRect = header.getBoundingClientRect();
        const triggerRect = megaTriggerNav.getBoundingClientRect();
        const gap = 8;
        const top = headerRect.bottom + gap;
        let left = Math.max(8, triggerRect.left);
        const margin = 12;
        const maxW = Math.min(1215, window.innerWidth - left - margin);
        megaPanel.style.top = `${top}px`;
        megaPanel.style.left = `${left}px`;
        megaPanel.style.width = `${maxW}px`;
    }

    function showMega() {
        positionMegaPanelFixed();
        megaPanel.classList.add('open');
        megaPanel.setAttribute('aria-hidden', 'false');
        megaTrigger?.setAttribute('aria-expanded', 'true');
    }

    function hideMega() {
        megaPanel.classList.remove('open');
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


document.querySelectorAll('a[href="#"]').forEach(a => {
    a.addEventListener('click', function (e) {
        e.preventDefault();
        if (this.textContent.trim().toLowerCase().includes('create')) {
            alert('Create account clicked');
        }
    });
});