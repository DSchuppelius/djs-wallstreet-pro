function snap(bgParallax, scrollSize) {
    if (bgParallax != null) {
        var scrollPosition = window.scrollY; //window.pageYOffset;
        var limit = bgParallax.offsetTop + bgParallax.offsetHeight;
        if (scrollPosition > bgParallax.offsetTop && scrollPosition <= limit){
            bgParallax.style.backgroundPositionY = scrollPosition / scrollSize + 'px';
        }else{
            bgParallax.style.backgroundPositionY = '0';
        }
        setTimeout(snap, 20, bgParallax, scrollSize);
    }
}

var timeoutId = null;
window.addEventListener('scroll', function(){
    if(timeoutId) clearTimeout(timeoutId);
        timeoutId = setTimeout(snap, 200, document.getElementsByClassName('custom-background')[0], 68);
}, true);
