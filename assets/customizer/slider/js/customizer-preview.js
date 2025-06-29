(function () {
    if (typeof wp === "undefined" || !wp.customize) {
        return;
    }

    const map = {
        wallstreet_logo_length: "--logo-width",
        wallstreet_logo_position: "--logo-top",
        wallstreet_fixed_logo_length: "--fixed-logo-width",
        wallstreet_fixed_logo_position: "--fixed-logo-top",
    };

    Object.keys(map).forEach((id) => {
        wp.customize(id, (setting) => {
            setting.bind((value) => {
                let v = parseFloat(value);
                if (isNaN(v)) {
                    v = 0;
                }
                if (id.endsWith("_length")) {
                    v = Math.min(v, 500);
                }

                /* hier: 3. Parameter 'important' */
                document.documentElement.style.setProperty(map[id], v + "px", "important");
            });
        });
    });
})();
