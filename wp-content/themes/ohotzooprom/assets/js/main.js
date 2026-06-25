document.addEventListener('DOMContentLoaded', () => {
    const tabs = document.querySelectorAll('.page-tabs__link');
    const contents = document.querySelectorAll('[data-tab-content]');

    if (tabs.length > 0) {
        tabs.forEach(tab => {
            tab.addEventListener('click', (e) => {
                e.preventDefault();
                
                // Remove active class from all tabs and contents
                tabs.forEach(t => t.classList.remove('active'));
                contents.forEach(c => c.classList.remove('active'));

                // Add active class to clicked tab
                tab.classList.add('active');

                // Show corresponding content
                const target = tab.getAttribute('data-tab');
                const targetContent = document.querySelector(`[data-tab-content="${target}"]`);
                if (targetContent) {
                    targetContent.classList.add('active');
                }

                // Update URL hash without scrolling
                history.pushState(null, null, `#${target}`);
            });
        });

        // Initialize active tab from URL hash if present
        const hash = window.location.hash.replace('#', '');
        if (hash) {
            const activeTab = document.querySelector(`.page-tabs__link[data-tab="${hash}"]`);
            if (activeTab) {
                activeTab.click();
            } else {
                tabs[0].click();
            }
        } else {
            // Default to first tab
            tabs[0].click();
        }

        // Handle hash change while on the same page
        window.addEventListener('hashchange', () => {
            const currentHash = window.location.hash.replace('#', '');
            if (currentHash) {
                const activeTab = document.querySelector(`.page-tabs__link[data-tab="${currentHash}"]`);
                if (activeTab && !activeTab.classList.contains('active')) {
                    activeTab.click();
                }
            }
        });
    }

    // Mobile menu toggle
    const burgerBtn = document.getElementById('burgerBtn');
    const headerNav = document.querySelector('.header__nav');
    
    if (burgerBtn && headerNav) {
        burgerBtn.addEventListener('click', () => {
            burgerBtn.classList.toggle('active');
            headerNav.classList.toggle('active');
            document.body.classList.toggle('no-scroll');
        });
    }

    // Toggle submenus on mobile
    const menuItemsWithChildren = document.querySelectorAll('.menu-item-has-children > a');
    menuItemsWithChildren.forEach(item => {
        item.addEventListener('click', (e) => {
            if (window.innerWidth <= 1024) {
                const subMenu = item.nextElementSibling;
                if (subMenu) {
                    e.preventDefault();
                    subMenu.classList.toggle('active');
                    const arrow = item.querySelector('.menu-arrow');
                    if (arrow) {
                        arrow.style.transform = subMenu.classList.contains('active') ? 'rotate(180deg)' : '';
                    }
                }
            }
        });
    });

    // Close menu when resizing beyond tablet breakpoint
    window.addEventListener('resize', () => {
        if (window.innerWidth > 1024) {
            if (burgerBtn && burgerBtn.classList.contains('active')) {
                burgerBtn.classList.remove('active');
                headerNav.classList.remove('active');
                document.body.classList.remove('no-scroll');
            }
        }
    });

    // Back to top button widget
    const backToTopBtn = document.createElement('button');
    backToTopBtn.className = 'back-to-top-btn';
    backToTopBtn.setAttribute('aria-label', 'Наверх');
    backToTopBtn.innerHTML = `
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="18 15 12 9 6 15"></polyline>
        </svg>
    `;
    document.body.appendChild(backToTopBtn);

    window.addEventListener('scroll', () => {
        if (window.scrollY > 300) {
            backToTopBtn.classList.add('visible');
        } else {
            backToTopBtn.classList.remove('visible');
        }
    });

    backToTopBtn.addEventListener('click', () => {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });

    // Dynamically inject and manage Search Modal
    const searchModalHtml = `
        <div class="search-modal" id="searchModal">
            <div class="search-modal__overlay"></div>
            <div class="search-modal__container">
                <button class="search-modal__close" id="searchCloseBtn" aria-label="Закрыть поиск">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
                <div class="search-modal__content">
                    <h2 class="search-modal__title">Поиск по сайту</h2>
                    <form class="search-modal__form" action="#" onsubmit="event.preventDefault();">
                        <div class="search-modal__field">
                            <input type="search" class="search-modal__input" placeholder="Что вы ищете?..." autocomplete="off">
                            <button type="submit" class="search-modal__submit" aria-label="Найти">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="11" cy="11" r="8"></circle>
                                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                </svg>
                            </button>
                        </div>
                    </form>
                    <div class="search-modal__hints">
                        <span class="search-modal__hints-label">Например:</span>
                        <div class="search-modal__hints-list">
                            <a href="#!" class="search-modal__hint-tag">охрана сайгаков</a>
                            <a href="#!" class="search-modal__hint-tag">госзакупки 2026</a>
                            <a href="#!" class="search-modal__hint-tag">контакты</a>
                            <a href="#!" class="search-modal__hint-tag">казахские борзые</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `;

    const tempDiv = document.createElement('div');
    tempDiv.innerHTML = searchModalHtml.trim();
    const searchModal = tempDiv.firstChild;
    document.body.appendChild(searchModal);

    const searchBtns = document.querySelectorAll('.search-btn');
    const searchCloseBtn = searchModal.querySelector('#searchCloseBtn');
    const searchOverlay = searchModal.querySelector('.search-modal__overlay');
    const searchInput = searchModal.querySelector('.search-modal__input');

    if (searchBtns.length > 0) {
        searchBtns.forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                searchModal.classList.add('active');
                document.body.classList.add('no-scroll');
                setTimeout(() => {
                    if (searchInput) searchInput.focus();
                }, 100);
            });
        });

        const closeSearch = () => {
            searchModal.classList.remove('active');
            if (headerNav && !headerNav.classList.contains('active')) {
                document.body.classList.remove('no-scroll');
            }
        };

        if (searchCloseBtn) {
            searchCloseBtn.addEventListener('click', closeSearch);
        }
        if (searchOverlay) {
            searchOverlay.addEventListener('click', closeSearch);
        }

        // Close on ESC key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && searchModal.classList.contains('active')) {
                closeSearch();
            }
        });
    }
});
