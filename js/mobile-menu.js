document.addEventListener('DOMContentLoaded', function () {
    var body = document.body;
    var toggle = document.querySelector('.smc-mobile-toggle');
    var menu = document.querySelector('.smc-mobile-menu');
    var overlay = document.querySelector('.smc-mobile-overlay');
    var closeBtn = document.querySelector('.smc-mobile-close');
    var searchInput = document.querySelector('#smc-mobile-search-input');
    var menuList = document.querySelector('.smcmobile-links');
    var recentWrap = document.querySelector('.smc-mobile-recent');
    var recentList = document.querySelector('.smc-mobile-recent-list');
    var focusableSelector = 'a[href], button:not([disabled]), input:not([disabled]), [tabindex]:not([tabindex="-1"])';

    if (!toggle || !menu || !overlay) {
        return;
    }

    var isOpen = false;
    var lastFocusedElement = null;

    function refreshIcons() {
        if (window.lucide && typeof window.lucide.createIcons === 'function') {
            window.lucide.createIcons();
        }
    }

    function getFocusableElements() {
        return Array.prototype.slice.call(menu.querySelectorAll(focusableSelector)).filter(function (el) {
            return el.offsetParent !== null;
        });
    }

    function renderRecentLinks() {
        if (!recentWrap || !recentList) {
            return;
        }

        var items = [];
        try {
            items = JSON.parse(localStorage.getItem('smc_mobile_recent') || '[]');
        } catch (e) {
            items = [];
        }

        if (!Array.isArray(items) || items.length === 0) {
            recentWrap.hidden = true;
            recentList.innerHTML = '';
            return;
        }

        recentWrap.hidden = false;
        recentList.innerHTML = items
            .map(function (item) {
                var safeUrl = String(item.url || '').replace(/"/g, '&quot;');
                var safeLabel = String(item.label || '')
                    .replace(/&/g, '&amp;')
                    .replace(/</g, '&lt;')
                    .replace(/>/g, '&gt;');
                return '<li><a href="' + safeUrl + '">' + safeLabel + '</a></li>';
            })
            .join('');
    }

    function storeRecentLink(link) {
        if (!link || !link.href) {
            return;
        }

        var url = link.href;
        var label = (link.textContent || '').trim();
        if (!label || !url) {
            return;
        }

        var items = [];
        try {
            items = JSON.parse(localStorage.getItem('smc_mobile_recent') || '[]');
        } catch (e) {
            items = [];
        }

        if (!Array.isArray(items)) {
            items = [];
        }

        items = items.filter(function (entry) {
            return entry.url !== url;
        });

        items.unshift({ label: label, url: url });
        items = items.slice(0, 4);

        localStorage.setItem('smc_mobile_recent', JSON.stringify(items));
    }

    function openMenu() {
        lastFocusedElement = document.activeElement;
        isOpen = true;
        menu.classList.add('active');
        body.classList.add('smc-mobile-menu-open');
        menu.setAttribute('aria-hidden', 'false');
        toggle.setAttribute('aria-expanded', 'true');

        var links = menu.querySelectorAll('.smcmobile-links > li');
        links.forEach(function (link, index) {
            link.style.animationDelay = index * 0.04 + 's';
            link.classList.add('slide-in');
        });

        var focusables = getFocusableElements();
        if (focusables.length > 0) {
            focusables[0].focus();
        }
    }

    function closeMenu() {
        isOpen = false;
        menu.classList.remove('active');
        body.classList.remove('smc-mobile-menu-open');
        menu.setAttribute('aria-hidden', 'true');
        toggle.setAttribute('aria-expanded', 'false');

        var links = menu.querySelectorAll('.smcmobile-links > li');
        links.forEach(function (link) {
            link.classList.remove('slide-in');
            link.style.animationDelay = '0s';
        });

        if (lastFocusedElement && typeof lastFocusedElement.focus === 'function') {
            lastFocusedElement.focus();
        }
    }

    function setupSubmenus() {
        if (!menuList) {
            return;
        }

        var parents = menuList.querySelectorAll('li.menu-item-has-children');
        parents.forEach(function (item, index) {
            var anchor = item.querySelector(':scope > a');
            var submenu = item.querySelector(':scope > .sub-menu');
            if (!anchor || !submenu) {
                return;
            }

            submenu.id = submenu.id || 'smc-mobile-submenu-' + index;
            submenu.style.display = 'none';

            var toggleBtn = document.createElement('button');
            toggleBtn.type = 'button';
            toggleBtn.className = 'smc-submenu-toggle';
            toggleBtn.setAttribute('aria-expanded', 'false');
            toggleBtn.setAttribute('aria-controls', submenu.id);
            toggleBtn.setAttribute('aria-label', 'Toggle submenu');
            toggleBtn.innerHTML = '<i data-lucide="chevron-down"></i>';

            toggleBtn.addEventListener('click', function () {
                var expanded = toggleBtn.getAttribute('aria-expanded') === 'true';
                toggleBtn.setAttribute('aria-expanded', expanded ? 'false' : 'true');
                submenu.style.display = expanded ? 'none' : 'block';
                item.classList.toggle('submenu-open', !expanded);
            });

            item.insertBefore(toggleBtn, submenu);

            if (item.classList.contains('current-menu-item') || item.classList.contains('current-menu-ancestor')) {
                toggleBtn.setAttribute('aria-expanded', 'true');
                submenu.style.display = 'block';
                item.classList.add('submenu-open');
            }
        });
    }

    function setupSearchFilter() {
        if (!searchInput || !menuList) {
            return;
        }

        searchInput.addEventListener('input', function () {
            var term = searchInput.value.trim().toLowerCase();
            var items = menuList.querySelectorAll(':scope > li');
            items.forEach(function (item) {
                var text = (item.textContent || '').toLowerCase();
                item.style.display = !term || text.indexOf(term) !== -1 ? 'block' : 'none';
            });
        });
    }

    function setupMenuIcons() {
        var menuItems = document.querySelectorAll('.smcmobile-links li > a');
        menuItems.forEach(function (item) {
            var text = (item.textContent || '').trim().toLowerCase();
            var iconName = 'chevron-right';

            if (text.indexOf('home') !== -1) iconName = 'house';
            else if (text.indexOf('about') !== -1) iconName = 'info';
            else if (text.indexOf('contact') !== -1) iconName = 'mail';
            else if (text.indexOf('assess') !== -1) iconName = 'clipboard-list';
            else if (text.indexOf('article') !== -1 || text.indexOf('blog') !== -1) iconName = 'book-open';
            else if (text.indexOf('service') !== -1) iconName = 'briefcase';

            if (!item.querySelector('.nav-icon')) {
                var icon = document.createElement('i');
                icon.className = 'nav-icon';
                icon.setAttribute('data-lucide', iconName);
                item.prepend(icon);
            }
        });
    }

    toggle.addEventListener('click', openMenu);
    if (closeBtn) {
        closeBtn.addEventListener('click', closeMenu);
    }
    overlay.addEventListener('click', closeMenu);

    menu.addEventListener('click', function (event) {
        var clickedLink = event.target.closest('a');
        if (!clickedLink) {
            return;
        }

        storeRecentLink(clickedLink);
        var parentItem = clickedLink.closest('li.menu-item-has-children');
        var isParentTrigger = !!(parentItem && parentItem.querySelector(':scope > .sub-menu') && parentItem.querySelector(':scope > a') === clickedLink);
        var isHashLink = (clickedLink.getAttribute('href') || '').trim() === '#';

        if (!isParentTrigger && !isHashLink) {
            closeMenu();
        }
    });

    document.addEventListener('keydown', function (event) {
        if (!isOpen) {
            return;
        }

        if (event.key === 'Escape') {
            closeMenu();
            return;
        }

        if (event.key === 'Tab') {
            var focusables = getFocusableElements();
            if (focusables.length === 0) {
                return;
            }

            var first = focusables[0];
            var last = focusables[focusables.length - 1];

            if (event.shiftKey && document.activeElement === first) {
                event.preventDefault();
                last.focus();
            } else if (!event.shiftKey && document.activeElement === last) {
                event.preventDefault();
                first.focus();
            }
        }
    });

    setupSubmenus();
    setupSearchFilter();
    setupMenuIcons();
    renderRecentLinks();
    refreshIcons();
});
