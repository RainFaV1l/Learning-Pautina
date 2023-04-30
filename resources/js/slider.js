const slider = () => {
    const prev = document.querySelector('.prev');
    const next = document.querySelector('.next');

    if(!prev || !next) return false;

    const swiper = new Swiper('.reviews-slider', {
        slidesPerView: 1,
        spaceBetween: 50,
        loop: true,

        breakpoints: {
            1280:{
                slidesPerView: 3,
            }
        }
    })

    prev.addEventListener('click', () => {
        swiper.slidePrev(500)
    })
    next.addEventListener('click', () => {
        swiper.slideNext(500)
    })
}

document.addEventListener("turbo:load", function() {
    slider()
})
