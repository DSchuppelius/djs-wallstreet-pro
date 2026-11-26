/*!
 * DJS-Wallstreet-Pro - lightbox.js
 * Bildvergroesserung mit nativem <dialog> (Fokusfalle, Escape, Hintergrund-Sperre vom
 * Browser). Ersetzt die jQuery-Lightbox und versteht deren Markup:
 *   <a href="bild.jpg" data-lightbox="gruppe" data-title="Bildunterschrift">
 * Links derselben Gruppe lassen sich mit Pfeiltasten/Buttons durchblaettern.
 */
(() => {
    "use strict";

    const l10n = Object.assign({ close: "Close", prev: "Previous", next: "Next" }, window.djsL10n || {});
    const isImage = (href) => /\.(jpe?g|png|gif|webp|avif|svg)(\?.*)?$/i.test(href);

    let dialog;
    let image;
    let caption;
    let group = [];
    let index = 0;

    const button = (cls, icon, label) =>
        `<button type="button" class="lightbox__btn ${cls} btn btn-circle"><span class="material-icons" aria-hidden="true">${icon}</span><span class="screen-reader-text">${label}</span></button>`;

    function build() {
        dialog = document.createElement("dialog");
        dialog.className = "lightbox";
        dialog.innerHTML =
            `<figure class="lightbox__figure"><img class="lightbox__img" alt=""><figcaption class="lightbox__caption"></figcaption></figure>` +
            button("lightbox__close", "close", l10n.close) +
            button("lightbox__prev", "chevron_left", l10n.prev) +
            button("lightbox__next", "chevron_right", l10n.next);
        document.body.appendChild(dialog);

        image = dialog.querySelector(".lightbox__img");
        caption = dialog.querySelector(".lightbox__caption");

        dialog.querySelector(".lightbox__close").addEventListener("click", () => dialog.close());
        dialog.querySelector(".lightbox__prev").addEventListener("click", () => show(index - 1));
        dialog.querySelector(".lightbox__next").addEventListener("click", () => show(index + 1));
        dialog.addEventListener("click", (e) => {
            if (e.target === dialog) dialog.close();
        });
        dialog.addEventListener("keydown", (e) => {
            if (e.key === "ArrowLeft") show(index - 1);
            if (e.key === "ArrowRight") show(index + 1);
        });
        dialog.addEventListener("close", () => {
            document.documentElement.classList.remove("lightbox-open");
            group[index]?.focus();
        });
    }

    function show(i) {
        index = (i + group.length) % group.length;
        const link = group[index];
        const thumb = link.querySelector("img");
        image.src = link.href;
        image.alt = thumb?.alt || "";
        const text = link.dataset.title || link.getAttribute("title") || thumb?.alt || "";
        caption.textContent = text;
        caption.hidden = text === "";
        dialog.classList.toggle("is-group", group.length > 1);
    }

    document.addEventListener("click", (e) => {
        if (e.defaultPrevented || e.button !== 0 || e.metaKey || e.ctrlKey || e.shiftKey) return;
        const link = e.target.closest("a[data-lightbox]");
        if (!link || !isImage(link.href)) return;
        e.preventDefault();

        if (!dialog) build();
        const name = link.dataset.lightbox;
        group = name && name !== "image" ? Array.from(document.querySelectorAll(`a[data-lightbox="${CSS.escape(name)}"]`)).filter((a) => isImage(a.href)) : [link];
        show(group.indexOf(link));
        document.documentElement.classList.add("lightbox-open");
        dialog.showModal();
    });
})();
