/*!
 * DJS-Wallstreet-Pro - carousel.js
 * Karussell ohne Abhaengigkeiten auf Basis von CSS scroll-snap. Ersetzt Flexslider und
 * carouFredSel (beide jQuery).
 *
 * Markup:  .carousel[data-carousel] > .carousel__viewport > .carousel__track > .carousel__slide
 * Optionen (data-*):
 *   effect    "slide" (Standard) | "fade"
 *   per-view  Slides gleichzeitig (Desktop; schmale Bildschirme zeigen weniger, siehe CSS)
 *   step      Slides pro Schritt
 *   speed     Dauer des Uebergangs in ms (fade)
 *   autoplay  Pause zwischen Wechseln in ms, 0 = aus
 * Autoplay pausiert bei Hover/Fokus, im Hintergrund-Tab, per Pause-Button und bei
 * "Bewegung reduzieren".
 */
(() => {
    "use strict";

    const reduceMotion = window.matchMedia("(prefers-reduced-motion: reduce)");
    const l10n = Object.assign({ slide: "Slide %1$s of %2$s", play: "Start automatic rotation", pause: "Pause automatic rotation" }, window.djsL10n || {});
    const fmt = (str, ...args) => args.reduce((s, a, i) => s.replace(`%${i + 1}$s`, a), str);

    class Carousel {
        constructor(root) {
            this.root = root;
            this.viewport = root.querySelector(".carousel__viewport");
            this.track = root.querySelector(".carousel__track");
            this.slides = this.track ? Array.from(this.track.children) : [];
            if (!this.viewport || this.slides.length === 0) return;

            this.effect = root.dataset.effect === "fade" ? "fade" : "slide";
            this.step = Math.max(1, parseInt(root.dataset.step || "1", 10) || 1);
            this.delay = parseInt(root.dataset.autoplay ?? "6000", 10) || 0;
            this.index = 0;
            this.timer = null;
            this.userPaused = false;
            this.holds = new Set();

            root.style.setProperty("--carousel-speed", `${parseInt(root.dataset.speed || "600", 10)}ms`);
            if (root.dataset.perView) root.style.setProperty("--per-view-max", root.dataset.perView);
            root.classList.add("is-ready", `carousel--${this.effect}`);
            this.slides.forEach((slide, i) => slide.setAttribute("aria-label", fmt(l10n.slide, i + 1, this.slides.length)));

            if (this.slides.length < 2) {
                root.classList.add("is-single");
                if (this.effect === "fade") this.slides[0].classList.add("is-active");
                return;
            }

            this.prevBtn = root.querySelector("[data-carousel-prev]");
            this.nextBtn = root.querySelector("[data-carousel-next]");
            this.pauseBtn = root.querySelector("[data-carousel-pause]");
            this.dotsBox = root.querySelector("[data-carousel-dots]");

            this.bind();
            this.buildDots();
            this.go(0, false);
            this.syncAutoplay();
        }

        perView() {
            if (this.effect === "fade") return 1;
            const value = parseFloat(getComputedStyle(this.root).getPropertyValue("--per-view"));
            return Number.isFinite(value) && value > 0 ? Math.round(value) : 1;
        }

        positions() {
            return this.effect === "fade" ? this.slides.length : Math.max(1, this.slides.length - this.perView() + 1);
        }

        go(index, smooth = true) {
            const max = this.positions();
            this.index = ((index % max) + max) % max;

            if (this.effect === "fade") {
                this.slides.forEach((slide, i) => {
                    const active = i === this.index;
                    slide.classList.toggle("is-active", active);
                    slide.inert = !active;
                });
            } else {
                const target = this.slides[this.index];
                const left = target.offsetLeft - this.slides[0].offsetLeft;
                this.viewport.scrollTo({ left, behavior: smooth && !reduceMotion.matches ? "smooth" : "auto" });
            }
            this.updateDots();
        }

        next() {
            const max = this.positions();
            this.go(this.index + this.step >= max && this.index < max - 1 ? max - 1 : this.index + this.step);
        }

        prev() {
            this.go(this.index - this.step < 0 && this.index > 0 ? 0 : this.index - this.step);
        }

        buildDots() {
            if (!this.dotsBox) return;
            this.dotsBox.textContent = "";
            this.dots = [];
            const count = this.positions();
            if (count < 2) return;
            for (let i = 0; i < count; i++) {
                const dot = document.createElement("button");
                dot.type = "button";
                dot.className = "carousel__dot";
                dot.setAttribute("aria-label", fmt(l10n.slide, i + 1, count));
                dot.addEventListener("click", () => {
                    this.go(i);
                    this.restart();
                });
                this.dotsBox.appendChild(dot);
                this.dots.push(dot);
            }
            this.updateDots();
        }

        updateDots() {
            (this.dots || []).forEach((dot, i) => {
                const on = i === this.index;
                dot.classList.toggle("is-active", on);
                if (on) dot.setAttribute("aria-current", "true");
                else dot.removeAttribute("aria-current");
            });
        }

        /* ---- Autoplay ------------------------------------------------ */
        canPlay() {
            return this.delay > 0 && !reduceMotion.matches && !this.userPaused && this.holds.size === 0 && !document.hidden;
        }

        syncAutoplay() {
            window.clearInterval(this.timer);
            this.timer = null;
            if (this.canPlay()) this.timer = window.setInterval(() => this.next(), this.delay);
            if (this.pauseBtn) {
                this.pauseBtn.hidden = this.delay <= 0 || reduceMotion.matches;
                this.pauseBtn.setAttribute("aria-pressed", String(this.userPaused));
                const icon = this.pauseBtn.querySelector(".material-icons");
                const label = this.pauseBtn.querySelector(".screen-reader-text");
                if (icon) icon.textContent = this.userPaused ? "play_arrow" : "pause";
                if (label) label.textContent = this.userPaused ? l10n.play : l10n.pause;
            }
        }

        restart() {
            if (this.timer) this.syncAutoplay();
        }

        hold(reason, on) {
            if (on) this.holds.add(reason);
            else this.holds.delete(reason);
            this.syncAutoplay();
        }

        bind() {
            this.prevBtn?.addEventListener("click", () => {
                this.prev();
                this.restart();
            });
            this.nextBtn?.addEventListener("click", () => {
                this.next();
                this.restart();
            });
            this.pauseBtn?.addEventListener("click", () => {
                this.userPaused = !this.userPaused;
                this.syncAutoplay();
            });

            this.root.addEventListener("mouseenter", () => this.hold("hover", true));
            this.root.addEventListener("mouseleave", () => this.hold("hover", false));
            this.root.addEventListener("focusin", () => this.hold("focus", true));
            this.root.addEventListener("focusout", (e) => {
                if (!this.root.contains(e.relatedTarget)) this.hold("focus", false);
            });
            document.addEventListener("visibilitychange", () => this.syncAutoplay());
            reduceMotion.addEventListener?.("change", () => this.syncAutoplay());

            this.viewport.tabIndex = 0;
            this.viewport.addEventListener("keydown", (e) => {
                if (e.key === "ArrowRight") {
                    e.preventDefault();
                    this.next();
                } else if (e.key === "ArrowLeft") {
                    e.preventDefault();
                    this.prev();
                }
            });

            // Wischen/Scrollen von Hand: Index aus der Position ableiten
            if (this.effect === "slide") {
                let raf = 0;
                this.viewport.addEventListener(
                    "scroll",
                    () => {
                        cancelAnimationFrame(raf);
                        raf = requestAnimationFrame(() => {
                            const width = this.slides.length > 1 ? this.slides[1].offsetLeft - this.slides[0].offsetLeft : this.viewport.clientWidth;
                            const index = Math.round(this.viewport.scrollLeft / Math.max(1, width));
                            if (index !== this.index) {
                                this.index = Math.min(index, this.positions() - 1);
                                this.updateDots();
                            }
                        });
                    },
                    { passive: true },
                );

                let lastPerView = this.perView();
                window.addEventListener(
                    "resize",
                    () => {
                        const perView = this.perView();
                        if (perView !== lastPerView) {
                            lastPerView = perView;
                            this.buildDots();
                            this.go(Math.min(this.index, this.positions() - 1), false);
                        }
                    },
                    { passive: true },
                );
            }
        }
    }

    const init = () => document.querySelectorAll("[data-carousel]").forEach((el) => new Carousel(el));
    if (document.readyState === "loading") document.addEventListener("DOMContentLoaded", init, { once: true });
    else init();
})();
