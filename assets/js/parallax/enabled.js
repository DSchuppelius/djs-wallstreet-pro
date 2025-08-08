// Performance-Check
const mqReduced = window.matchMedia("(prefers-reduced-motion: reduce)");
function canRun() {
    if (mqReduced.matches) return false;
    const cores = navigator.hardwareConcurrency ?? 4; // fallback blockiert nicht
    const ram = typeof navigator.deviceMemory === "number" ? navigator.deviceMemory : 8;
    if (cores < 8 || ram < 8) return false;
    const t0 = performance.now();
    for (let i = 0; i < 60000; i++) Math.sqrt(i);
    return performance.now() - t0 <= 50;
}
let effectsEnabled = canRun();
mqReduced.addEventListener?.("change", () => (effectsEnabled = canRun()));

// Parallax (wie gewünscht)
function snap(bgParallax, scrollSize) {
    if (!effectsEnabled || !bgParallax) return;
    const scrollPosition = window.scrollY;
    const limit = bgParallax.offsetTop + bgParallax.offsetHeight;
    if (scrollPosition > bgParallax.offsetTop && scrollPosition <= limit) {
        bgParallax.style.backgroundPositionY = scrollPosition / scrollSize + "px";
    } else {
        bgParallax.style.backgroundPositionY = "0";
    }
    setTimeout(snap, 20, bgParallax, scrollSize);
}

let timeoutId = null;
window.addEventListener(
    "scroll",
    function () {
        if (!effectsEnabled) return;
        if (timeoutId) clearTimeout(timeoutId);
        timeoutId = setTimeout(snap, 200, document.getElementsByClassName("custom-background")[0], 68);
    },
    { passive: true },
);

// Optional: einmalig initial setzen
if (effectsEnabled) {
    snap(document.getElementsByClassName("custom-background")[0], 68);
}
