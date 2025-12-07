/**
 * Theme Toggle
 * -------------------------------------------------------------------------------------
 * Handles light/dark/system theme switching with localStorage persistence
 */

'use strict';

(function () {
    const STORAGE_KEY = 'theme';
    const THEME_LIGHT = 'light';
    const THEME_DARK = 'dark';
    const THEME_SYSTEM = 'system';

    // Get stored theme from localStorage
    function getStoredTheme() {
        return localStorage.getItem(STORAGE_KEY);
    }

    // Store theme in localStorage
    function setStoredTheme(theme) {
        localStorage.setItem(STORAGE_KEY, theme);
    }

    // Get preferred theme based on system preference
    function getPreferredTheme() {
        const storedTheme = getStoredTheme();
        if (storedTheme) {
            return storedTheme;
        }
        return window.matchMedia('(prefers-color-scheme: dark)').matches ? THEME_DARK : THEME_LIGHT;
    }

    // Get actual theme (resolve 'system' to light/dark)
    function getActualTheme(theme) {
        if (theme === THEME_SYSTEM) {
            return window.matchMedia('(prefers-color-scheme: dark)').matches ? THEME_DARK : THEME_LIGHT;
        }
        return theme;
    }

    // Apply theme to document
    function setTheme(theme) {
        const actualTheme = getActualTheme(theme);
        const html = document.documentElement;
        
        // Update HTML attributes for Bootstrap/Sneat theme
        if (actualTheme === THEME_DARK) {
            html.classList.remove('light-style');
            html.classList.add('dark-style');
            html.setAttribute('data-bs-theme', 'dark');
        } else {
            html.classList.remove('dark-style');
            html.classList.add('light-style');
            html.setAttribute('data-bs-theme', 'light');
        }

        // Update active icon in navbar
        updateActiveIcon(theme);
    }

    // Update the active icon shown in navbar
    function updateActiveIcon(theme) {
        const activeIcon = document.querySelector('.theme-icon-active');
        if (!activeIcon) return;

        // Remove all icon classes and add the correct one
        activeIcon.classList.remove('bx-sun', 'bx-moon', 'bx-desktop');
        
        switch (theme) {
            case THEME_DARK:
                activeIcon.classList.add('bx-moon');
                break;
            case THEME_SYSTEM:
                activeIcon.classList.add('bx-desktop');
                break;
            case THEME_LIGHT:
            default:
                activeIcon.classList.add('bx-sun');
                break;
        }

        // Update aria-label
        const navTheme = document.getElementById('nav-theme');
        if (navTheme) {
            navTheme.setAttribute('aria-label', `Toggle theme (${theme})`);
        }
    }

    // Update active state in dropdown menu
    function updateDropdownActiveState(theme) {
        const buttons = document.querySelectorAll('[data-bs-theme-value]');
        buttons.forEach(button => {
            const buttonTheme = button.getAttribute('data-bs-theme-value');
            const isActive = buttonTheme === theme;
            
            button.classList.toggle('active', isActive);
            button.setAttribute('aria-pressed', isActive.toString());
        });
    }

    // Initialize theme toggle functionality
    function initThemeToggle() {
        // Apply stored/preferred theme immediately
        const preferredTheme = getPreferredTheme();
        setTheme(preferredTheme);
        updateDropdownActiveState(preferredTheme);

        // Add click handlers to theme toggle buttons
        document.querySelectorAll('[data-bs-theme-value]').forEach(button => {
            button.addEventListener('click', function () {
                const theme = this.getAttribute('data-bs-theme-value');
                setStoredTheme(theme);
                setTheme(theme);
                updateDropdownActiveState(theme);
            });
        });

        // Listen for system theme changes
        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
            const storedTheme = getStoredTheme();
            if (storedTheme === THEME_SYSTEM || !storedTheme) {
                setTheme(THEME_SYSTEM);
            }
        });
    }

    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initThemeToggle);
    } else {
        initThemeToggle();
    }

    // Apply theme immediately to prevent flash
    const storedTheme = getStoredTheme();
    if (storedTheme) {
        setTheme(storedTheme);
    }
})();
