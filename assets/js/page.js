// ===== Performance-aware UI =====
const maxWidth = "1199px";

// -------- helpers
const mqNarrow = window.matchMedia(`(max-width: ${maxWidth})`);
const prefersReducedMotion = window.matchMedia("(prefers-reduced-motion: reduce)");
const PASSIVE = { passive: true };

function hasEnoughPerformance() {
    console.log("Evaluating performance...");
    if (prefersReducedMotion.matches) return false;

    const cores = navigator.hardwareConcurrency ?? 2;
    const ram = navigator.deviceMemory ?? 2; // GB

    if (cores < 4 || ram < 4) return false;

    // Mini-Benchmark (kurz halten)
    const t0 = performance.now();
    let s = 0;
    for (let i = 1; i <= 200000; i++) s += Math.sqrt(i);
    const dt = performance.now() - t0;
    return dt <= 120; // Schwelle feinjustieren
}

function rafThrottle(fn) {
    let running = false;
    return function (...args) {
        if (running) return;
        running = true;
        requestAnimationFrame(() => {
            running = false;
            fn.apply(this, args);
        });
    };
}

function debounce(fn, wait = 150) {
    let t;
    return (...a) => {
        clearTimeout(t);
        t = setTimeout(() => fn.apply(null, a), wait);
    };
}

// -------- core
function setClassesOnPage($) {
    const isFixedHeader = document.getElementsByClassName("fixed_Header").length > 0;
    const isFixedFooter = document.getElementsByClassName("fixed_Footer").length > 0;

    // Cache DOM
    const bod = $("body");
    const nav = $(".navbar-wrapper");
    const men = $(".navbar-collapse");
    const btn = $(".navbar-toggle");
    const footerEl = $("footer.site");
    const headerTop = $(".header-top-area");

    const state = {
        headerTopHeight: headerTop.length ? headerTop.height() : 0,
        effectsEnabled: hasEnoughPerformance(),
    };

    const myPage = {
        footer() {
            if (mqNarrow.matches) footerEl.removeClass("fixed");
            else footerEl.addClass("fixed");
        },
        header(isScrolled) {
            if (isScrolled && !mqNarrow.matches) {
                bod.removeClass("body-static-top").addClass("body-fixed-top");
                nav.removeClass("navbar-static-top").addClass("navbar-fixed-top");
                men.removeClass("in");
                btn.addClass("collapsed");
            } else {
                bod.addClass("body-static-top").removeClass("body-fixed-top");
                nav.addClass("navbar-static-top").removeClass("navbar-fixed-top");
            }
        },
        applyPostAnimations() {
            if (!state.effectsEnabled) return;
            document.querySelectorAll(".col-md-8 .post:not(:first-child)").forEach((post) => {
                const randomDelay = Math.floor(Math.random() * 6 + 2);
                post.style.cssText += `animation: gradientShift ${randomDelay}s ease-in-out infinite;`;
            });
        },
        markEmptyEmbeds() {
            document.querySelectorAll(".wp-block-embed__wrapper").forEach((parent) => {
                if (parent.children.length === 0) parent.classList.add("no-element");
            });
        },
    };

    // Initial
    myPage.markEmptyEmbeds();
    if (isFixedFooter) myPage.footer();
    if (isFixedHeader) {
        myPage.header(window.scrollY > state.headerTopHeight);
    }
    myPage.applyPostAnimations();

    // Events
    if (isFixedHeader) {
        const onScroll = rafThrottle(() => {
            myPage.header(window.scrollY > state.headerTopHeight);
        });
        window.addEventListener("scroll", onScroll, PASSIVE);
    }

    const onResize = debounce(() => {
        state.headerTopHeight = headerTop.length ? headerTop.height() : 0;
        if (isFixedHeader) myPage.header(window.scrollY > state.headerTopHeight);
        if (isFixedFooter) myPage.footer();
    }, 150);

    window.addEventListener("resize", onResize, PASSIVE);
    mqNarrow.addEventListener?.("change", onResize);
    prefersReducedMotion.addEventListener?.("change", () => {
        // Re-evaluate performance if user toggles reduced motion
        state.effectsEnabled = hasEnoughPerformance();
        // Reapply header state without animations if disabled now
        if (isFixedHeader) myPage.header(window.scrollY > state.headerTopHeight);
    });
}

// -------- boot
jQuery(document).ready(function ($) {
    setClassesOnPage($);
});

document.addEventListener("DOMContentLoaded", function () {
    // Falls jQuery verspätet lädt: Fallback nur für Embed-Markierung.
    document.querySelectorAll(".wp-block-embed__wrapper").forEach(function (parent) {
        if (parent.children.length === 0) parent.classList.add("no-element");
    });
});

const defaultFontSize = 16; // Standardgröße in Pixel

function adjustFontSize(change) {
    const content = document.documentElement; // Root-Element (<html>)
    let currentSize = parseFloat(window.getComputedStyle(content).fontSize);
    let newSize = currentSize + change;

    // Grenze setzen (min 10px, max 19px)
    if (newSize >= 14 && newSize <= 19) {
        content.style.fontSize = newSize + "px";
        localStorage.setItem("fontSize", newSize); // Speichern der Größe
    }
}

// Schriftgröße auf Standardwert zurücksetzen
function resetFontSize() {
    document.documentElement.style.fontSize = defaultFontSize + "px";
    localStorage.setItem("fontSize", defaultFontSize);
}

// Schriftgröße beim Laden wiederherstellen
document.addEventListener("DOMContentLoaded", () => {
    let savedSize = localStorage.getItem("fontSize");
    if (savedSize) {
        document.documentElement.style.fontSize = savedSize + "px";
    }
});
