jQuery(function () {
    // This js For Portfolio Related Projects Section
    jQuery('#related_project_scroll').carouFredSel({
        width: '100%',
        responsive : true,
        circular: true,
        items: {
            height: '65%',
            visible: {
                min: 1,
                max: 3,
            }
        },
        directon: 'left',
        auto: true,
        prev: '#project_prev',
        next: '#project_next',
        scroll: {
            items: 1,
            duration: 1200,
            timeoutDuration: 2000
        },
    });
});
