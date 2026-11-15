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
 * 10. Tabs
 * 11. Kleinigkeiten (leere Embeds markieren)
 * 12. Verschiebbare Dialoge
 * 13. Einwilligungs-Fenster: gleich breite Button-Paare
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
        const header = doc.querySelector("[data-site-header]");
        if (!header) return;

        const sticky = header.classList.contains("is-sticky");
        const topbar = doc.querySelector(".site-topbar");
        const bar = header.querySelector(".site-header__bar");
        const stacked = header.classList.contains("site-header--stacked");

        const measure = () => {
            // Seitenbreite ohne Scrollbalken (CSS: --page-w, z. B. fuer die Bannerhoehe)
            root.style.setProperty("--page-w", `${root.clientWidth}px`);
            // Glas-Header: Banner und Slider liegen darunter (CSS: --header-h). Gemessen wird nur
            // im Ausgangszustand, der verkleinerte Header soll den Seitenkopf nicht verschieben.
            if (!header.classList.contains("is-scrolled")) {
                const margin = parseFloat(getComputedStyle(header).marginTop) || 0;
                root.style.setProperty("--header-h", `${Math.round(header.offsetHeight + margin)}px`);
            }
            if (!sticky) return;
            // Gestapelte Header: die Logo-Zeile scrollt weg, die Menueleiste bleibt stehen.
            const hide = stacked && mqNav.matches && bar ? bar.offsetHeight : 0;
            header.style.setProperty("--header-hide", `${hide}px`);
            root.style.setProperty("--sticky-offset", `${header.offsetHeight - hide}px`);
        };

        // Fester Platz im Seitenfluss: Der Header ist sticky (liegt im Fluss). Verkleinert er sich,
        // wuerde der ganze Inhalt nachruecken und ruckeln. Die Differenz zur Ausgangshoehe wird
        // deshalb als Aussenabstand unten ausgeglichen - der Inhalt bleibt stehen wie beim bisherigen
        // fixierten Header. Laeuft auch waehrend der Uebergaenge (ResizeObserver, vor dem Zeichnen).
        let baseHeight = 0;
        const keepFlow = () => {
            if (!header.classList.contains("is-scrolled")) {
                header.style.marginBottom = "";
                baseHeight = header.offsetHeight;
                return;
            }
            const diff = baseHeight - header.offsetHeight;
            header.style.marginBottom = diff !== 0 ? `${diff}px` : "";
        };

        // Hysterese: Der verkleinerte Header verschiebt den Inhalt, und das Scroll-Anchoring des
        // Browsers zieht scrollY um genau diese Differenz zurueck. Mit nur einer Schwelle kippt der
        // Zustand dabei hin und her (Flackern). Verkleinert wird deshalb erst, wenn scrollY auch nach
        // dem Schrumpfen noch ueber der Schwelle liegt (Differenz <= aktuelle Header-Hoehe);
        // vergroessert wird erst, wenn die Schwelle wieder unterschritten ist.
        let scrolled = false;
        const update = rafThrottle(() => {
            const threshold = (topbar ? topbar.offsetHeight : 0) + 16;
            const y = window.scrollY;
            const next = scrolled ? y > threshold : y > threshold + header.offsetHeight;
            if (next === scrolled) return;
            scrolled = next;
            header.classList.toggle("is-scrolled", scrolled);
            doc.body.classList.toggle("body-fixed-top", scrolled);
            keepFlow();
        });

        measure();
        keepFlow();
        if (sticky) {
            update();
            window.addEventListener("scroll", update, PASSIVE);
        }
        if ("ResizeObserver" in window) {
            const throttledMeasure = rafThrottle(measure);
            new ResizeObserver(() => {
                if (sticky) keepFlow();
                throttledMeasure();
            }).observe(header);
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

        const setOpen = (open) => {
            bar.classList.toggle("is-open", open);
            peek.setAttribute("aria-expanded", String(open));
        };

        peek.addEventListener("click", () => setOpen(!bar.classList.contains("is-open")));

        // Das Info-Symbol blendet beim Aufklappen aus - geschlossen wird per Klick daneben oder Escape
        doc.addEventListener("click", (event) => {
            if (bar.classList.contains("is-open") && !bar.contains(event.target) && !peek.contains(event.target)) setOpen(false);
        });
        doc.addEventListener("keydown", (event) => {
            if (event.key === "Escape" && bar.classList.contains("is-open")) {
                setOpen(false);
                peek.focus();
            }
        });
    }

    /* ------------------------------------------------------------------
     * 6b. Cookie-Knopf der Extensions: am Desktop links in der Kopfleiste
     *     (wie bisher), auf schmalen Bildschirmen unten links
     * ---------------------------------------------------------------- */
    function initCookieControl() {
        const control = doc.querySelector(".cookie-control");
        const bar = doc.querySelector("[data-site-header] .site-header__bar");
        if (!control || !bar) return;

        const place = () => {
            const target = mqNav.matches ? bar : doc.body;
            if (control.parentNode !== target) target.appendChild(control);
        };

        place();
        mqNav.addEventListener("change", place);
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
     * Sie erscheint nur, wenn das Laden dauert (CSS: 0,3 s Verzoegerung), zeigt den echten
     * Fortschritt (Seite, Schriften, noch ladende Bilder) als Lichtlinie im Glasrahmen und geht
     * mit dem load-Ereignis. Seitenwechsel laufen ohne kuenstliche Wartezeit. Die Blende faengt
     * keine Klicks ab (CSS pointer-events: none), auch nicht beim Ausblenden.
     * ---------------------------------------------------------------- */
    function initPageFader() {
        const fader = doc.getElementById("page_fader");
        if (!fader) return;

        const setProgress = (value) => fader.style.setProperty("--p", String(Math.round(Math.min(100, Math.max(0, value)))));
        let leaveTimer = 0;

        const hide = (instant = false) => {
            window.clearTimeout(leaveTimer);
            if (fader.classList.contains("is-hidden")) return;
            setProgress(100);
            const opacity = parseFloat(getComputedStyle(fader).opacity) || 0;
            if (instant || opacity < 0.05 || mqReducedMotion.matches || typeof fader.animate !== "function") {
                fader.classList.add("is-hidden");
                return;
            }
            // Schon sichtbar: den vollen Rahmen kurz zeigen, dann weich ausblenden
            fader
                .animate([{ opacity }, { opacity: 0 }], { duration: 350, delay: 200, easing: "ease", fill: "forwards" })
                .finished.then(() => {
                    fader.classList.add("is-hidden");
                    fader.getAnimations().forEach((animation) => animation.cancel());
                })
                .catch(() => {});
        };

        // Fortschritt: die Seite selbst (das Skript laeuft deferred), die Schriften und alle Bilder,
        // die gerade noch laden (spaet nachladende loading="lazy"-Bilder zaehlen nicht).
        const pending = Array.from(doc.images).filter((img) => !img.complete && img.loading !== "lazy");
        const total = pending.length + 2;
        let done = 1;
        const step = () => {
            done += 1;
            setProgress((done / total) * 100);
        };
        setProgress((done / total) * 100);
        pending.forEach((img) => {
            img.addEventListener("load", step, { once: true });
            img.addEventListener("error", step, { once: true });
        });
        if (doc.fonts) doc.fonts.ready.then(step);
        else step();

        if (doc.readyState === "complete") {
            hide(true);
        } else {
            window.addEventListener("load", () => hide(), { once: true });
            // Spaetestens nach 2,5 s freigeben, auch wenn ein externes Bild haengt.
            window.setTimeout(() => hide(), 2500);
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

            // Keine kuenstliche Wartezeit: der Browser navigiert sofort, die Blende erscheint (CSS)
            // erst, wenn die naechste Seite auf sich warten laesst. Faengt ein spaeteres Skript den
            // Klick doch noch ab, bleibt sie aus.
            window.setTimeout(() => {
                if (event.defaultPrevented) return;
                fader.getAnimations().forEach((animation) => animation.cancel());
                setProgress(0);
                fader.classList.remove("is-hidden");
                // Kein Seitenwechsel gefolgt (Download, 204 ...): wieder freigeben
                leaveTimer = window.setTimeout(() => hide(), 8000);
            }, 0);
        });

        // Zurueck-Button (bfcache): Blende sofort entfernen
        window.addEventListener("pageshow", (event) => {
            if (event.persisted) hide(true);
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
                // Wie bisher: das feste Hintergrundbild wandert ganz langsam mit (1/68 der Strecke).
                // Inline, weil WordPress' Customizer-<style> sonst die Position vorgibt.
                if (parallaxBg) body.style.backgroundPositionY = `${(y / 68).toFixed(1)}px`;
                // Bild bleibt um den Faktor hinter der Seite zurueck (0.8 = laeuft mit 20 % Tempo, wie
                // parallax.js mit speed 0.2), sobald der Banner oben aus dem Bild laeuft.
                images.forEach((img) => {
                    const box = img.parentElement.getBoundingClientRect();
                    if (box.bottom < 0 || box.top > window.innerHeight) return;
                    const factor = parseFloat(img.dataset.parallax) || 0.8;
                    img.style.transform = `translate3d(0, ${Math.round(Math.max(0, -box.top) * factor)}px, 0)`;
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
     * 10. Tabs ([data-tabs] mit role="tab"-Links, z. B. Portfolio-Kategorien)
     *     Ohne JS sind es normale Links (?tab=slug); mit JS wird ohne Neuladen umgeschaltet.
     * ---------------------------------------------------------------- */
    function initTabs() {
        doc.querySelectorAll("[data-tabs]").forEach((list) => {
            const tabs = Array.from(list.querySelectorAll('[role="tab"]'));
            const activate = (tab, focus) => {
                tabs.forEach((t) => {
                    const on = t === tab;
                    t.classList.toggle("tab-active", on);
                    t.setAttribute("aria-selected", String(on));
                    t.tabIndex = on ? 0 : -1;
                    const pane = doc.getElementById(t.getAttribute("aria-controls"));
                    if (pane) pane.hidden = !on;
                });
                if (focus) tab.focus();
                if (tab.href) window.history.replaceState(null, "", tab.href);
            };

            tabs.forEach((tab) => {
                tab.tabIndex = tab.getAttribute("aria-selected") === "true" ? 0 : -1;
                tab.addEventListener("click", (event) => {
                    if (event.metaKey || event.ctrlKey || event.shiftKey || event.button !== 0) return;
                    event.preventDefault();
                    activate(tab, false);
                });
            });

            list.addEventListener("keydown", (event) => {
                const current = tabs.indexOf(doc.activeElement);
                if (current < 0) return;
                const moves = { ArrowRight: 1, ArrowDown: 1, ArrowLeft: -1, ArrowUp: -1 };
                if (event.key in moves) {
                    event.preventDefault();
                    activate(tabs[(current + moves[event.key] + tabs.length) % tabs.length], true);
                } else if (event.key === "Home" || event.key === "End") {
                    event.preventDefault();
                    activate(tabs[event.key === "Home" ? 0 : tabs.length - 1], true);
                }
            });
        });
    }

    /* ------------------------------------------------------------------
     * 11. Kleinigkeiten
     * ---------------------------------------------------------------- */
    /** Schliessen-Button in Hinweisen ([alert]-Shortcode) */
    function initDismiss() {
        doc.addEventListener("click", (event) => {
            const button = event.target.closest('[data-dismiss="alert"]');
            if (!button) return;
            button.closest(".alert")?.remove();
        });
    }

    /** Anker auf eine Akkordeon-Sektion (<details id>) oeffnet sie */
    function openTargetDetails() {
        const open = () => {
            if (!window.location.hash) return;
            let target;
            try {
                target = doc.querySelector(decodeURIComponent(window.location.hash));
            } catch (e) {
                return;
            }
            const details = target?.closest("details");
            if (details) {
                details.open = true;
                details.scrollIntoView({ block: "start" });
            }
        };
        open();
        window.addEventListener("hashchange", open);
    }

    /* ------------------------------------------------------------------
     * 12. Verschiebbare Dialoge
     * Fenster lassen sich am Griff (Titelzeile) mit Maus, Stift oder Finger verschieben.
     * Die Position steht in --drag-x/--drag-y (CSS) und wird beim Schliessen zurueckgesetzt.
     * ---------------------------------------------------------------- */
    const DRAGGABLE = [
        ["#script_fullscreen", ".title_row"], // Einwilligung (DJS-Extensions)
        [".site-search__box", null], // Vollbild-Suche: das ganze Fenster ausser Eingaben
    ];

    function initDraggable() {
        DRAGGABLE.forEach(([boxSelector, handleSelector]) => {
            doc.querySelectorAll(boxSelector).forEach((box) => {
                const handle = handleSelector ? box.querySelector(handleSelector) : box;
                if (!handle) return;
                box.classList.add("is-draggable");
                let drag = null;

                const place = (x, y) => {
                    box.style.setProperty("--drag-x", `${Math.round(x)}px`);
                    box.style.setProperty("--drag-y", `${Math.round(y)}px`);
                };
                // classList.remove schreibt das class-Attribut auch ohne Aenderung neu und loest damit
                // den MutationObserver unten erneut aus. Deshalb nur anfassen, wenn wirklich gesetzt.
                const stopDragging = () => {
                    drag = null;
                    if (box.classList.contains("is-dragging")) box.classList.remove("is-dragging");
                };
                const reset = () => {
                    stopDragging();
                    place(0, 0);
                };

                handle.addEventListener("pointerdown", (event) => {
                    if (event.button !== 0 || event.target.closest("button, a, input, select, textarea, label")) return;
                    const style = getComputedStyle(box);
                    drag = {
                        x: event.clientX,
                        y: event.clientY,
                        dx: parseFloat(style.getPropertyValue("--drag-x")) || 0,
                        dy: parseFloat(style.getPropertyValue("--drag-y")) || 0,
                        rect: box.getBoundingClientRect(),
                    };
                    handle.setPointerCapture(event.pointerId);
                    box.classList.add("is-dragging");
                    event.preventDefault();
                });

                handle.addEventListener("pointermove", (event) => {
                    if (!drag) return;
                    const { rect } = drag;
                    // Griff bleibt immer im sichtbaren Bereich
                    const mx = Math.min(Math.max(event.clientX - drag.x, 120 - rect.right), window.innerWidth - 120 - rect.left);
                    const my = Math.min(Math.max(event.clientY - drag.y, -rect.top), window.innerHeight - 48 - rect.top);
                    place(drag.dx + mx, drag.dy + my);
                });

                handle.addEventListener("pointerup", stopDragging);
                handle.addEventListener("pointercancel", stopDragging);

                // Beim naechsten Oeffnen wieder mittig
                const dialog = box.closest("dialog");
                if (dialog) {
                    dialog.addEventListener("close", reset);
                } else {
                    // Nur beim Wechsel offen -> zu zuruecksetzen, sonst schaukeln sich Observer und
                    // reset() endlos auf (Seite friert ein, z. B. beim Schliessen der Einwilligung).
                    let wasOpen = box.classList.contains("open");
                    new MutationObserver(() => {
                        const isOpen = box.classList.contains("open");
                        if (wasOpen && !isOpen) reset();
                        wasOpen = isOpen;
                    }).observe(box, { attributes: true, attributeFilter: ["class"] });
                }
            });
        });
    }

    /* ------------------------------------------------------------------
     * 13. Einwilligungs-Fenster: gleich breite Button-Paare
     * Jede Zeile (Skript-Paar im Formular, Cookie-Paar in der Fusszeile) wird so breit wie ihre
     * laengere Beschriftung: --btn-row-w in em, damit die Schriftgroessen-Einstellung mitskaliert.
     * Das CSS kuerzt einzeilig mit Ellipse; gekuerzte Buttons zeigen den vollen Text als Tooltip.
     * ---------------------------------------------------------------- */
    function initConsentButtons() {
        const box = doc.getElementById("script_fullscreen");
        if (!box) return;
        const rows = [box.querySelector("form.script"), box.querySelector("form.script .footer_row")].filter(Boolean);
        const buttonsOf = (row) => Array.from(row.children).filter((el) => el.matches(".btn"));
        const all = rows.flatMap(buttonsOf);
        if (!all.length) return;

        const measure = () => {
            // Alle auf natuerliche Breite stellen, einmal lesen, zuruecksetzen (zwei Layouts statt acht)
            all.forEach((btn) => {
                btn.style.flex = "none";
                btn.style.maxWidth = "none";
                btn.style.width = "max-content";
            });
            const widths = new Map(all.map((btn) => [btn, btn.offsetWidth]));
            all.forEach((btn) => {
                btn.style.flex = btn.style.maxWidth = btn.style.width = "";
            });
            rows.forEach((row) => {
                const buttons = buttonsOf(row);
                if (!buttons.length) return;
                const width = Math.max(...buttons.map((btn) => widths.get(btn))) + 1;
                const fontSize = parseFloat(getComputedStyle(buttons[0]).fontSize) || 16;
                row.style.setProperty("--btn-row-w", `${(width / fontSize).toFixed(3)}em`);
            });
        };

        const markTruncated = () => {
            all.forEach((btn) => {
                if (btn.scrollWidth > btn.clientWidth + 1) btn.title = btn.textContent.trim();
                else btn.removeAttribute("title");
            });
        };

        measure();
        if (doc.fonts) doc.fonts.ready.then(measure);
        if ("ResizeObserver" in window) {
            const observer = new ResizeObserver(markTruncated);
            all.forEach((btn) => observer.observe(btn));
        }
    }

    /**
     * Galerien im alten Block-Format (<figure><ul class="blocks-gallery-grid">): Jetpack Carousel
     * sucht seine Daten am <ul>, WordPress schreibt sie aber an die <figure>. Ohne Kopie oeffnet
     * ein Klick aufs Bild nichts. Neue Galerien (has-nested-images) brauchen das nicht.
     */
    function linkLegacyGalleries() {
        doc.querySelectorAll("figure.wp-block-gallery[data-carousel-extra]:not(.has-nested-images)").forEach((figure) => {
            const list = figure.querySelector(":scope > ul.blocks-gallery-grid:not([data-carousel-extra])");
            if (list) list.setAttribute("data-carousel-extra", figure.getAttribute("data-carousel-extra"));
        });
    }

    /** Beitragslisten wie bisher: der Schatten oben an den Kacheln (ab der zweiten) wandert
     *  zweimal hin und her, je Kachel 2-7s lang. Startet erst, wenn die Kachel ins Bild kommt. */
    function initPostShade() {
        if (!effectsAllowed() || !("IntersectionObserver" in window)) return;
        const cards = doc.querySelectorAll(".has-frame .page-shell.layout:not(.layout--sidebar-none) .post-list > .post-card.type-post:not(:first-child)");
        if (!cards.length) return;
        const observer = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry) => {
                    if (!entry.isIntersecting) return;
                    const card = entry.target;
                    card.style.setProperty("--shade-duration", `${Math.floor(Math.random() * 6 + 2)}s`);
                    card.classList.add("has-shade-shift");
                    observer.unobserve(card);
                });
            },
            { threshold: 0.15 },
        );
        cards.forEach((card) => observer.observe(card));
    }

    function markEmptyEmbeds() {
        doc.querySelectorAll(".wp-block-embed__wrapper").forEach((wrapper) => {
            if (wrapper.children.length === 0) wrapper.classList.add("no-element");
        });
    }

    /** 3D-Tag-Cloud (Plugin "HTML5 Cumulus", TagCanvas): Die Zeichenflaeche ist fest (meist
     *  400x400) und wird per CSS auf die Spaltenbreite verkleinert. Ist das Widget breiter (Tablet,
     *  Sidebar unter dem Inhalt), wird sie vor dem Start auf die volle Breite verbreitert: Die Kugel
     *  bleibt gleich gross (TagCanvas richtet sie nach der kuerzeren Seite), lange Woerter am Rand
     *  haben Platz, statt abgeschnitten zu werden. Laeuft vor jQuery(document).ready des Plugins. */
    function fitTagCanvas() {
        doc.querySelectorAll('.sidebar-widget canvas[id^="canvas-"]').forEach((canvas) => {
            const box = canvas.closest(".tagcloud") || canvas.parentElement;
            const width = Math.floor(box.clientWidth);
            if (width > canvas.width) {
                canvas.width = width;
            }
        });
    }

    const init = () => {
        fitTagCanvas();
        initNavigation();
        initStickyHeader();
        initPopovers();
        initSearchDialog();
        initDisplaySettings();
        initFixedFooter();
        initCookieControl();
        initScrollTop();
        initPageFader();
        initParallax();
        initTabs();
        initDismiss();
        openTargetDetails();
        markEmptyEmbeds();
        linkLegacyGalleries();
        initDraggable();
        initPostShade();
        initConsentButtons();
    };

    if (doc.readyState === "loading") {
        doc.addEventListener("DOMContentLoaded", init, { once: true });
    } else {
        init();
    }
})();
