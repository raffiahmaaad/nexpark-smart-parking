<style>
    nav.navbar {
        box-shadow: none !important;
        background: transparent !important;
        padding: 20px 0 !important;
        position: fixed !important;
        width: 100% !important;
        top: 0 !important;
        z-index: 1000 !important;
        transition: all 0.3s ease !important;
    }

    nav.navbar.scrolled {
        background: rgba(255, 255, 255, 0.98) !important;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1) !important;
        padding: 20px 0 !important;
        position: fixed !important;
        width: 100% !important;
        top: 0 !important;
        z-index: 1000 !important;
        transition: all 0.3s ease !important;
    }

    .navbar .container {
        padding: 0 40px !important;
        max-width: 100% !important;
        height: 45px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: space-between !important;
        gap: 40px !important;
    }

    .navbar-brand-area {
        display: flex !important;
        align-items: center !important;
        flex-shrink: 0 !important;
        width: 200px !important;
    }

    .navbar .navbar-brand {
        color: #00d084 !important;
        font-size: 2.2rem !important;
        font-weight: 800 !important;
        letter-spacing: 1px;
        padding: 0 !important;
        margin: 0 !important;
        line-height: 1 !important;
        white-space: nowrap !important;
    }

    .navbar .navbar-brand span {
        color: #00d084 !important;
    }

    .navbar-collapse {
        display: flex !important;
        justify-content: center !important;
        flex-grow: 1 !important;
        margin: 0 !important;
    }

    .navbar .navbar-nav {
        display: flex !important;
        gap: 40px !important;
        margin: 0 !important;
        padding: 0 !important;
        align-items: center !important;
        justify-content: center !important;
        width: 100% !important;
        max-width: 600px !important;
    }

    .navbar .navbar-nav .nav-item {
        margin: 0 !important;
        padding: 0 !important;
    }

    .navbar .navbar-nav .nav-link {
        color: #fff !important;
        font-weight: 600 !important;
        font-size: 1rem !important;
        transition: color 0.2s;
        padding: 0 !important;
        line-height: 45px !important;
        white-space: nowrap !important;
        letter-spacing: 0.5px !important;
    }

    .navbar.scrolled .navbar-nav .nav-link {
        color: #333 !important;
    }

    .navbar .navbar-nav .nav-link:hover,
    .navbar.scrolled .navbar-nav .nav-link:hover {
        color: #00d084 !important;
    }

    .navbar .navbar-nav .nav-item.active .nav-link {
        color: #00d084 !important;
    }

    .navbar-user-area {
        display: flex !important;
        align-items: center !important;
        margin: 0 !important;
        padding: 0 !important;
        height: 45px !important;
        flex-shrink: 0 !important;
        width: 200px !important;
        justify-content: flex-end !important;
    }

    /* Google Login Button */
    .google-login {
        background-color: #00d084 !important;
        color: #fff !important;
        border: none !important;
        border-radius: 25px !important;
        padding: 0 15px !important;
        font-weight: 600 !important;
        font-size: 1rem !important;
        display: flex !important;
        align-items: center !important;
        gap: 8px !important;
        transition: background-color 0.2s !important;
        height: 45px !important;
        box-shadow: 0 4px 15px rgba(0, 208, 132, 0.2) !important;
        margin: 0 !important;
        white-space: nowrap !important;
        letter-spacing: 0.5px !important;
    }

    .google-login:hover {
        background-color: #00b873 !important;
        color: #fff !important;
    }

    /* User Dropdown */
    .nav-user-dropdown {
        margin: 0 !important;
        padding: 0 !important;
        height: 45px !important;
        position: relative !important;
    }

    .user-navbar-btn {
        background: #1a1a1a !important;
        border: none !important;
        border-radius: 25px !important;
        padding: 0 12px !important;
        display: flex !important;
        align-items: center !important;
        gap: 8px !important;
        height: 45px !important;
        min-width: 120px !important;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1) !important;
        margin: 0 !important;
        position: relative !important;
        transition: all 0.2s ease !important;
        cursor: pointer !important;
        user-select: none !important;
        -webkit-user-select: none !important;
    }

    .user-navbar-btn:focus {
        outline: none !important;
        box-shadow: 0 0 0 2px #00d084 !important;
    }

    .user-navbar-btn.active {
        background: #222 !important;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15) !important;
    }

    .user-name-wrapper {
        position: relative !important;
        display: flex !important;
        align-items: center !important;
        gap: 6px !important;
    }

    .user-name-wrapper::after {
        content: '' !important;
        display: block !important;
        width: 6px !important;
        height: 6px !important;
        border: 2px solid #00d084 !important;
        border-left: 0 !important;
        border-top: 0 !important;
        transform: rotate(45deg) !important;
        transition: all 0.2s ease !important;
        opacity: 0.7 !important;
        margin-top: -2px !important;
        flex-shrink: 0 !important;
    }

    .user-navbar-btn.active .user-name-wrapper::after {
        transform: rotate(-135deg) !important;
        margin-top: 2px !important;
        opacity: 1 !important;
    }

    .user-navbar-btn img,
    .user-navbar-btn .user-icon-navbar {
        width: 32px !important;
        height: 32px !important;
        border-radius: 50% !important;
        background: #6c3428 !important;
        color: #00d084 !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        font-size: 1.2rem !important;
        flex-shrink: 0 !important;
    }

    .user-name-navbar {
        font-weight: 600 !important;
        font-size: 1rem !important;
        color: #00d084 !important;
        white-space: nowrap !important;
        letter-spacing: 0.5px !important;
    }

    /* Remove hover effects from dropdown */
    .dropdown:hover .dropdown-menu {
        display: none !important;
    }

    .dropdown-menu:hover {
        display: none !important;
    }

    .user-dropdown-menu {
        position: absolute !important;
        min-width: 280px !important;
        padding: 0 !important;
        border: none !important;
        border-radius: 15px !important;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2) !important;
        margin-top: 10px !important;
        right: 0 !important;
        left: auto !important;
        background: #1a1a1a !important;
        overflow: hidden !important;
        visibility: hidden !important;
        opacity: 0 !important;
        transform: translateY(-10px) !important;
        transition: all 0.3s ease !important;
        z-index: 1000 !important;
    }

    .user-dropdown-menu.show {
        visibility: visible !important;
        opacity: 1 !important;
        transform: translateY(0) !important;
        display: block !important;
    }

    .user-dropdown-header {
        padding: 20px !important;
        display: flex !important;
        align-items: center !important;
        gap: 15px !important;
        border-bottom: 1px solid rgba(0, 208, 132, 0.1) !important;
        background: #1a1a1a !important;
    }

    .user-dropdown-header img,
    .user-dropdown-header .user-icon-navbar {
        width: 45px !important;
        height: 45px !important;
        border-radius: 50% !important;
        background: #6c3428 !important;
        color: #fff !important;
        flex-shrink: 0 !important;
    }

    .user-dropdown-header .user-name-navbar {
        font-size: 1.1rem !important;
        margin-bottom: 1px !important;
        color: #00d084 !important;
        font-weight: 500 !important;
        line-height: 1.2 !important;
    }

    .user-dropdown-header .user-email-navbar {
        font-size: 0.9rem !important;
        color: #00d084 !important;
        white-space: nowrap !important;
        overflow: hidden !important;
        text-overflow: ellipsis !important;
        line-height: 1.2 !important;
    }

    /* Recent Bookings Section */
    .recent-bookings-section {
        padding: 15px 20px !important;
        border-bottom: 1px solid rgba(0, 208, 132, 0.1) !important;
        background: #1a1a1a !important;
    }

    .recent-bookings-section .section-title {
        font-size: 0.9rem !important;
        color: #00d084 !important;
        margin-bottom: 12px !important;
        font-weight: 500 !important;
        letter-spacing: 0.5px !important;
        border: none !important;
    }

    .booking-item {
        padding: 12px !important;
        background: rgba(0, 208, 132, 0.05) !important;
        border-radius: 10px !important;
        margin-bottom: 8px !important;
        transition: all 0.2s ease !important;
    }

    .booking-item:last-child {
        margin-bottom: 0 !important;
    }

    .booking-item:hover {
        background: rgba(0, 208, 132, 0.1) !important;
    }

    .booking-info {
        font-size: 0.85rem !important;
    }

    .booking-info>div {
        margin-bottom: 6px !important;
        display: flex !important;
        align-items: center !important;
        gap: 10px !important;
    }

    .booking-info>div:last-child {
        margin-bottom: 0 !important;
    }

    .booking-info i {
        color: #00d084 !important;
        width: 16px !important;
        text-align: center !important;
        font-size: 0.9rem !important;
    }

    .vehicle-info {
        font-weight: 500 !important;
        color: #00d084 !important;
        letter-spacing: 0.3px !important;
    }

    .parking-location {
        color: #00d084 !important;
    }

    .booking-date {
        color: #00d084 !important;
        font-size: 0.8rem !important;
    }

    .logout-info-btn {
        background: #ff4757 !important;
        color: #fff !important;
        border: none !important;
        border-radius: 12px !important;
        padding: 12px !important;
        font-weight: 600 !important;
        width: calc(100% - 40px) !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        gap: 8px !important;
        transition: all 0.2s ease !important;
        margin: 15px 20px !important;
        letter-spacing: 0.5px !important;
    }

    .logout-info-btn:hover {
        background: #ff3748 !important;
        transform: translateY(-1px) !important;
    }

    .logout-info-btn .fas {
        font-size: 1.1rem !important;
    }

    .dropdown-divider {
        margin: 0 !important;
        border-color: #eee !important;
    }

    .dropdown-menu .user-name-navbar,
    .dropdown-menu .user-email-navbar,
    .dropdown-menu .section-title,
    .dropdown-menu .booking-info,
    .dropdown-menu .vehicle-info,
    .dropdown-menu .parking-location,
    .dropdown-menu .booking-date {
        color: #00d084 !important;
    }

    @media (max-width: 991.98px) {
        .navbar .container {
            padding: 0 20px !important;
            gap: 20px !important;
        }

        .navbar-brand-area,
        .navbar-user-area {
            width: auto !important;
        }

        .navbar-collapse {
            background: rgba(255, 255, 255, 0.98) !important;
            padding: 20px !important;
            border-radius: 15px !important;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1) !important;
            margin-top: 10px !important;
            position: absolute !important;
            width: calc(100% - 40px) !important;
            top: 100% !important;
            left: 20px !important;
        }

        .navbar .navbar-nav {
            flex-direction: column !important;
            gap: 1rem !important;
            align-items: flex-start !important;
            max-width: 100% !important;
        }

        .navbar .navbar-nav .nav-link,
        .navbar.scrolled .navbar-nav .nav-link {
            color: #333 !important;
            line-height: 1.5 !important;
            padding: 8px 0 !important;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Navbar scroll handling
        var navbar = document.querySelector('.navbar');
        window.addEventListener('scroll', function () {
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // User dropdown handling
        const userButton = document.querySelector('.user-navbar-btn');
        const userDropdown = document.querySelector('.user-dropdown-menu');
        let isDropdownOpen = false;

        function toggleDropdown(e) {
            e.preventDefault();
            e.stopPropagation();
            isDropdownOpen = !isDropdownOpen;
            if (isDropdownOpen) {
                userDropdown.classList.add('show');
                userButton.classList.add('active');
            } else {
                userDropdown.classList.remove('show');
                userButton.classList.remove('active');
            }
        }

        function closeDropdown() {
            if (isDropdownOpen) {
                isDropdownOpen = false;
                userDropdown.classList.remove('show');
                userButton.classList.remove('active');
            }
        }

        if (userButton && userDropdown) {
            // Handle click and keyboard events
            userButton.addEventListener('click', toggleDropdown);
            userButton.addEventListener('keydown', function (e) {
                if (e.key === 'Enter' || e.key === ' ') {
                    toggleDropdown(e);
                }
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', function (e) {
                if (!userDropdown.contains(e.target) && !userButton.contains(e.target)) {
                    closeDropdown();
                }
            });

            // Close dropdown when pressing Escape
            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape') {
                    closeDropdown();
                }
            });

            // Prevent dropdown from closing when clicking inside it
            userDropdown.addEventListener('click', function (e) {
                e.stopPropagation();
            });
        }
    });
</script>
