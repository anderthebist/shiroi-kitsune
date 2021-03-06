
const swiper = new Swiper('.head-slider',{
    loop: true,
    speed: 500,
    preloadImages:false,
    //allowTouchMove: false,
    watchOverflow: true,
    watchSlidesVisibility: true,
    lazy:{
        loadOnTransitionStart: true,
        loadPrevNext: true
    },
    pagination: {
        el: '.header__pagin',
        clickable: true
    },
    autoplay: {
        delay: 6000,
        disableOnInteraction: false
    }
});


const relizeSwiper = new Swiper('.relize-slider',{
    speed: 600,
    slidesPerGroup: 2,
    freeMode: true,
    preloadImages:false,
    lazy:{
        loadOnTransitionStart: true,
        loadPrevNext: true,
        threshold: 50,
        loadPrevNextAmount: 5,
    },
    slidesPerView: 'auto',
    centeredSlides: false,
    watchOverflow: true,
    watchSlidesVisibility: true,
    navigation: {
        nextEl: '.context-panel__arrow_next',
        prevEl: '.context-panel__arrow_prev'
    },
    breakpoints: {
        // when window width is >= 320px
        0: {
            spaceBetween: 5
        },
        468: {
            spaceBetween: 10
        },
        1100: {
          spaceBetween: 15
        },
    }
});