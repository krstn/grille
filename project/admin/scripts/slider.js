var currSlide = 0, prevSlide;
var slides;
var slidesCount, slideWidth;
var slideInterval, slideAnimInterval;

function initSlider() {
    slides = document.getElementById("slides");
    slidesCount = getDivChildCount(slides);
    slideWidth = slides.offsetWidth;
    
    startSlider();
}

function startSlider() {
    clearInterval(slideInterval);
    slideInterval = setInterval(function() {
        slideNext();
    }, 5000);
}

function slideNext() {
    prevSlide = currSlide;
    if(++currSlide >= slidesCount) currSlide = 0;
    slideTo(slides, currSlide * slideWidth, easeOut);
    startSlider();
}

function slidePrev() {
    prevSlide = currSlide;
    if(--currSlide < 0) currSlide = slidesCount - 1;
    slideTo(slides, currSlide * slideWidth, easeOut);
    startSlider();
}

function slideTo(element, scrollTo, delta, duration) {
    var scrollFrom = element.scrollLeft;
    var scrollX = scrollTo - scrollFrom;
    animate({
        delay: 10,
        duration: duration || 1000,
        delta: delta,
        step: function(delta) {
            element.scrollLeft = scrollFrom  + (scrollX * delta);
        }
    });
}