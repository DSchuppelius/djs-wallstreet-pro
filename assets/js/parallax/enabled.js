// -------- capability check
const mqReduced = window.matchMedia("(prefers-reduced-motion: reduce)");

function hasEnoughPerformance() {
    if (mqReduced.matches) return false;

    const cores = navigator.hardwareConcurrency ?? 4;
    // Wenn deviceMemory fehlt, NICHT blockieren
    const ram = typeof navigator.deviceMemory === "number" ? navigator.deviceMemory : 8;

    if (cores < 8) return false;
    if (ram < 8) return false;

    // sehr kurzer Microbench, großzügige Schwelle
    const t0 = performance.now();
    for (let i = 0; i < 80000; i++) Math.sqrt(i);
    return performance.now() - t0 <= 60;
}

let effectsEnabled = hasEnoughPerformance();
mqReduced.addEventListener?.("change", () => (effectsEnabled = hasEnoughPerformance()));

// -------- parallax snap (rAF-basiert)
(function initParallax() {
    const el = document.getElementsByClassName("custom-background")[0];
    if (!el) return;

    const scrollSize = 68;
    let ticking = false;

    function update() {
        ticking = false;
        if (!effectsEnabled) {
            el.style.backgroundPositionY = "0";
            return;
        }
        const y = window.scrollY;
        const top = el.offsetTop;
        const limit = top + el.offsetHeight;
        el.style.backgroundPositionY = y > top && y <= limit ? y / scrollSize + "px" : "0";
    }

    function onScroll() {
        if (!ticking) {
            ticking = true;
            requestAnimationFrame(update);
        }
    }

    // Initial setzen und Listener registrieren
    update();
    window.addEventListener("scroll", onScroll, { passive: true });

    // Resize-Handling, falls Höhe/Position sich ändern
    let resizeTimer;
    window.addEventListener(
        "resize",
        () => {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(() => {
                effectsEnabled = hasEnoughPerformance();
                update();
            }, 150);
        },
        { passive: true },
    );
})();
