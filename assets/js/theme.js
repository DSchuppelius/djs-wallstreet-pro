/*!
 * DJS-Wallstreet-Pro - theme.js
 * Seitenverhalten ohne jQuery/Bootstrap. Ersetzt menu.js, page.js, page_fader.js,
 * parallax/enabled.js, parallax.min.js und djs.js.
 *
 *  1. Hauptnavigation (mobil: Panel + Akkordeon, Desktop: Hover/Fokus/Klick)
 *  2. Fester Header (Customizer "Fixed header")
 *  3. Pop-overs im Header (Suche, Darstellung)
 *  4. Vollbild-Suche (<dialog>)
 *  5. Schriftgroesse und Farbschema
 *  6. Fester Footer (Customizer "Fixed footer")
 *  7. Nach-oben-Button
 *  8. Ladeblende (Customizer "Fader")
 *  9. Parallax (Hintergrund, Header-Bild, Rellax-Ebenen)
 * 10. Kleinigkeiten (leere Embeds markieren)
 */
(() => {
    "use strict";

    const doc = document;
    const root = doc.documentElement;
    const mqNav = window.matchMedia("(min-width: 70rem)");
    const mqHover = window.matchMedia("(hover: hover) and (pointer: fine)");
    const mqReducedMotion = window.matchMedia("(prefers-reduced-motion: reduce)");
    const PASSIVE = { passive: true };

    const storage = {
        get(key) {
            try {
                return window.localStorage.getItem(key);
            } catch (e) {
                return null;
            }
        },
        set(key, value) {
            try {
                window.localStorage.setItem(key, value);
            } catch (e) {
                /* Privater Modus o. ae. - dann eben ohne Speichern */
            }
        },
        remove(key) {
            try {
                window.localStorage.removeItem(key);
            } catch (e) {
                /* siehe oben */
            }
        },
    };

    const rafThrottle = (fn) => {
        let queued = false;
        return (...args) => {
            if (queued) return;
            queued = true;
            window.requestAnimationFrame(() => {
                queued = false;
                fn(...args);
            });
        };
    };

    /** Effekte nur auf Geraeten, die sie fluessig darstellen und wenn niemand weniger Bewegung wuenscht. */
    const effectsAllowed = () => {
        if (mqReducedMotion.matches) return false;
        const cores = navigator.hardwareConcurrency || 4;
        const memory = typeof navigator.deviceMemory === "number" ? navigator.deviceMemory : 8;
        return cores >= 4 && memory >= 4;
    };

    /* ------------------------------------------------------------------
     * 1. Hauptnavigation
     * ---------------------------------------------------------------- */
    function initNavigation() {
        const header = doc.querySelector("[data-site-header]");
        const nav = doc.getElementById("site-navigation");
        if (!header || !nav) return;

        const toggle = header.querySelector("[data-nav-toggle]");
        const submenuButton = (li) => li.querySelector(":scope > .site-menu__row > .site-menu__toggle, :scope > .site-menu__parent");

        const placeSubmenu = (li) => {
            const sub = li.querySelector(":scope > .sub-menu");
            if (!sub || !mqNav.matches) return;
            li.classList.remove("flip");
            const rect = sub.getBoundingClientRect();
            if (rect.right > window.innerWidth - 8) li.classList.add("flip");
        };

        const setSubmenu = (li, open) => {
            li.classList.toggle("is-open", open);
            submenuButton(li)?.setAttribute("aria-expanded", String(open));
            if (open) placeSubmenu(li);
            if (!open) li.querySelectorAll("li.is-open").forEach((child) => setSubmenu(child, false));
        };

        const closeAll = (except = null) => {
            nav.querySelectorAll("li.is-open").forEach((li) => {
                if (!except || !li.contains(except)) setSubmenu(li, false);
            });
        };

        const setNavOpen = (open) => {
            header.classList.toggle("nav-open", open);
            toggle?.setAttribute("aria-expanded", String(open));
            root.classList.toggle("nav-locked", open && !mqNav.matches);
            if (!open) closeAll();
        };

        toggle?.addEventListener("click", () => setNavOpen(!header.classList.contains("nav-open")));

        nav.addEventListener("click", (event) => {
            const button = event.target.closest(".site-menu__toggle, .site-menu__parent");
            if (!button || !nav.contains(button)) return;
            const li = button.closest("li");
            const open = !li.classList.contains("is-open");
            li.parentElement.querySelectorAll(":scope > li.is-open").forEach((sibling) => {
                if (sibling !== li) setSubmenu(sibling, false);
            });
            setSubmenu(li, open);
        });

        // Desktop mit Maus: Untermenues oeffnen per Hover (CSS); hier nur Ausrichtung + Aufraeumen.
        nav.querySelectorAll(".menu-item-has-children, .page_item_has_children").forEach((li) => {
            li.addEventListener("mouseenter", () => {
                if (mqNav.matches && mqHover.matches) placeSubmenu(li);
            });
            li.addEventListener("mouseleave", () => {
                if (mqNav.matches && mqHover.matches && li.classList.contains("is-open")) setSubmenu(li, false);
            });
        });

        // Tastatur: Fokus verlaesst ein offenes Untermenue -> schliessen (Desktop)
        nav.addEventListener("focusout", (event) => {
            if (!mqNav.matches) return;
            nav.querySelectorAll("li.is-open").forEach((li) => {
                if (!li.contains(event.relatedTarget)) setSubmenu(li, false);
            });
        });

        doc.addEventListener("keydown", (event) => {
            if (event.key !== "Escape") return;
            const openItems = nav.querySelectorAll("li.is-open");
            if (openItems.length) {
                const last = openItems[openItems.length - 1];
                setSubmenu(last, false);
                submenuButton(last)?.focus();
                return;
            }
            if (header.classList.contains("nav-open")) {
                setNavOpen(false);
                toggle?.focus();
            }
        });

        doc.addEventListener("click", (event) => {
            if (!header.contains(event.target)) {
                closeAll();
                if (header.classList.contains("nav-open")) setNavOpen(false);
            } else if (!nav.contains(event.target)) {
                closeAll();
            }
        });

        mqNav.addEventListener("change", () => setNavOpen(false));
    }

    /* ------------------------------------------------------------------
     * 2. Fester Header
     * ---------------------------------------------------------------- */
    function initStickyHeader() {
        const header = doc.querySelector("[data-site-header].is-sticky");
        if (!header) return;

        const topbar = doc.querySelector(".site-topbar");
        const bar = header.querySelector(".site-header__bar");
        const stacked = header.classList.contains("site-header--stacked");

        const measure = () => {
            // Gestapelte Header: die Logo-Zeile scrollt weg, die Menueleiste bleibt stehen.
            const hide = stacked && mqNav.matches && bar ? bar.offsetHeight : 0;
            header.style.setProperty("--header-hide", `${hide}px`);
            root.style.setProperty("--sticky-offset", `${header.offsetHeight - hide}px`);
        };

        const update = rafThrottle(() => {
            const threshold = (topbar ? topbar.offsetHeight : 0) + 16;
            const scrolled = window.scrollY > threshold;
            header.classList.toggle("is-scrolled", scrolled);
            doc.body.classList.toggle("body-fixed-top", scrolled);
        });

        measure();
        update();
        window.addEventListener("scroll", update, PASSIVE);
        if ("ResizeObserver" in window) {
            new ResizeObserver(rafThrottle(measure)).observe(header);
        } else {
            window.addEventListener("resize", rafThrottle(measure), PASSIVE);
        }
        mqNav.addEventListener("change", measure);
    }

    /* ------------------------------------------------------------------
     * 3. Pop-overs (<details data-popover>)
     * ---------------------------------------------------------------- */
    function initPopovers() {
        const popovers = Array.from(doc.querySelectorAll("details[data-popover]"));
        if (!popovers.length) return;

        popovers.forEach((details) => {
            details.addEventListener("toggle", () => {
                if (!details.open) return;
                popovers.forEach((other) => {
                    if (other !== details) other.open = false;
                });
                details.querySelector("input[type=search], input[type=text]")?.focus();
            });
        });

        doc.addEventListener("click", (event) => {
            popovers.forEach((details) => {
                if (details.open && !details.contains(event.target)) details.open = false;
            });
        });

        doc.addEventListener("keydown", (event) => {
            if (event.key !== "Escape") return;
            popovers.forEach((details) => {
                if (details.open) {
                    details.open = false;
                    details.querySelector("summary")?.focus();
                }
            });
        });
    }

    /* ------------------------------------------------------------------
     * 4. Vollbild-Suche
     * ---------------------------------------------------------------- */
    function initSearchDialog() {
        const dialog = doc.getElementById("site-search");
        if (!dialog || typeof dialog.showModal !== "function") return;

        doc.querySelectorAll("[data-search-open]").forEach((button) => {
            button.addEventListener("click", () => {
                dialog.showModal();
                dialog.querySelector("input[type=search]")?.focus();
            });
        });
    }

    /* ------------------------------------------------------------------
     * 5. Schriftgroesse und Farbschema
     * ---------------------------------------------------------------- */
    function initDisplaySettings() {
        const FONT_KEY = "fontSize";
        const COLOR_KEY = "djs-color-mode";

        const baseSize = parseFloat(getComputedStyle(root).getPropertyValue("--general-font-size")) || 16;
        const minSize = baseSize - 2;
        const maxSize = baseSize + 3;

        doc.querySelectorAll("[data-font-size]").forEach((button) => {
            button.addEventListener("click", () => {
                const step = parseInt(button.dataset.fontSize, 10);
                if (step === 0) {
                    root.style.removeProperty("font-size");
                    storage.remove(FONT_KEY);
                    return;
                }
                const current = parseFloat(getComputedStyle(root).fontSize) || baseSize;
                const next = Math.min(maxSize, Math.max(minSize, current + step));
                root.style.fontSize = `${next}px`;
                storage.set(FONT_KEY, String(next));
            });
        });

        const colorButtons = doc.querySelectorAll("[data-color-mode]");
        if (!colorButtons.length) return;

        const serverDefault = root.dataset.colorDefault || "auto";
        const markActive = () => {
            const active = storage.get(COLOR_KEY) || serverDefault;
            colorButtons.forEach((button) => {
                const on = button.dataset.colorMode === active;
                button.setAttribute("aria-checked", String(on));
                button.classList.toggle("btn-active", on);
            });
        };

        colorButtons.forEach((button) => {
            button.addEventListener("click", () => {
                const mode = button.dataset.colorMode;
                if (mode === "auto") {
                    root.removeAttribute("data-theme");
                } else {
                    root.setAttribute("data-theme", `wallstreet-${mode}`);
                }
                storage.set(COLOR_KEY, mode);
                markActive();
            });
        });

        markActive();
    }

    /* ------------------------------------------------------------------
     * 6. Fester Footer: auf Touch-Geraeten per Button aufklappen
     * ---------------------------------------------------------------- */
    function initFixedFooter() {
        const peek = doc.querySelector("[data-footer-peek]");
        const bar = doc.querySelector("[data-footer-bar]");
        if (!peek || !bar) return;

        peek.addEventListener("click", () => {
            const open = !bar.classList.contains("is-open");
            bar.classList.toggle("is-open", open);
            peek.setAttribute("aria-expanded", String(open));
        });
    }

    /* ------------------------------------------------------------------
     * 7. Nach oben
     * ---------------------------------------------------------------- */
    function initScrollTop() {
        const button = doc.querySelector("[data-scroll-top]");
        if (!button) return;

        const update = rafThrottle(() => button.classList.toggle("is-visible", window.scrollY > 400));
        window.addEventListener("scroll", update, PASSIVE);
        update();

        button.addEventListener("click", (event) => {
            event.preventDefault();
            window.scrollTo({ top: 0, behavior: mqReducedMotion.matches ? "auto" : "smooth" });
            doc.getElementById("site-content")?.focus({ preventScroll: true });
        });
    }

    /* ------------------------------------------------------------------
     * 8. Ladeblende
     * ---------------------------------------------------------------- */
    function initPageFader() {
        const fader = doc.getElementById("page_fader");
        if (!fader) return;

        const hide = () => fader.classList.add("is-hidden");
        if (doc.readyState === "complete") {
            hide();
        } else {
            window.addEventListener("load", hide, { once: true });
            // Spaetestens nach 2,5 s ausblenden, auch wenn ein externes Bild haengt.
            window.setTimeout(hide, 2500);
        }

        const skipFile = /\.(jpe?g|png|gif|webp|avif|svg|pdf|zip|mp3|mp4|m4a|webm)$/i;

        doc.addEventListener("click", (event) => {
            if (event.defaultPrevented || event.button !== 0 || event.metaKey || event.ctrlKey || event.shiftKey || event.altKey) return;

            const link = event.target.closest("a[href]");
            if (!link || link.hasAttribute("download")) return;
            if (link.target && link.target !== "_self") return;
            if (link.hasAttribute("data-carousel-extra") || link.hasAttribute("data-vc-accordion") || link.hasAttribute("data-no-fader") || link.hasAttribute("data-lightbox")) return;

            let url;
            try {
                url = new URL(link.href, window.location.href);
            } catch (e) {
                return;
            }
            if (url.origin !== window.location.origin) return;
            if (url.pathname === window.location.pathname && url.search === window.location.search) return;
            if (skipFile.test(url.pathname) || url.pathname.includes("/wp-admin")) return;

            event.preventDefault();
            fader.classList.remove("is-hidden");
            window.setTimeout(() => window.location.assign(url.href), mqReducedMotion.matches ? 0 : 320);
        });

        // Zurueck-Button (bfcache): Blende wieder entfernen
        window.addEventListener("pageshow", (event) => {
            if (event.persisted) hide();
        });
    }

    /* ------------------------------------------------------------------
     * 9. Parallax
     * ---------------------------------------------------------------- */
    function initParallax() {
        if (!effectsAllowed()) return;

        // Seitenhintergrund (Customizer "Parallax Background")
        const body = doc.body;
        const parallaxBg = body.classList.contains("parallax-background") && body.classList.contains("custom-background");

        // Header-Bild (Customizer "Parallax Header")
        const images = Array.from(doc.querySelectorAll("img[data-parallax]"));

        if (parallaxBg || images.length) {
            const update = rafThrottle(() => {
                const y = window.scrollY;
                if (parallaxBg) body.style.setProperty("--bg-shift", `${Math.round(y / -6)}px`);
                images.forEach((img) => {
                    const box = img.parentElement.getBoundingClientRect();
                    if (box.bottom < 0 || box.top > window.innerHeight) return;
                    const factor = parseFloat(img.dataset.parallax) || 0.3;
                    img.style.transform = `translate3d(0, ${Math.round(-box.top * factor)}px, 0) scale(1.15)`;
                });
            });
            window.addEventListener("scroll", update, PASSIVE);
            update();
        }

        // Rellax-Ebenen (Customizer "Rellax Speed ..."). Nur Elemente mit Geschwindigkeit != 0 -
        // ein transform auf grossen Containern bricht sonst position:fixed darin.
        if (typeof window.Rellax === "function") {
            const layers = Array.from(doc.querySelectorAll(".rellax")).filter((el) => parseFloat(el.dataset.rellaxSpeed || "0") !== 0);
            if (layers.length) {
                layers.forEach((el) => el.classList.add("rellax-active"));
                window.rellax = new window.Rellax(".rellax-active", { center: false });
            }
        }
    }

    /* ------------------------------------------------------------------
     * 10. Kleinigkeiten
     * ---------------------------------------------------------------- */
    function markEmptyEmbeds() {
        doc.querySelectorAll(".wp-block-embed__wrapper").forEach((wrapper) => {
            if (wrapper.children.length === 0) wrapper.classList.add("no-element");
        });
    }

    const init = () => {
        initNavigation();
        initStickyHeader();
        initPopovers();
        initSearchDialog();
        initDisplaySettings();
        initFixedFooter();
        initScrollTop();
        initPageFader();
        initParallax();
        markEmptyEmbeds();
    };

    if (doc.readyState === "loading") {
        doc.addEventListener("DOMContentLoaded", init, { once: true });
    } else {
        init();
    }
})();
