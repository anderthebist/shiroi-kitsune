document.addEventListener('DOMContentLoaded', (event) => {
    
    const swiper = new Swiper('.team-slider',{
        effect: "coverflow",
        grabCursor: true,
        centeredSlides: true,
        slidesPerView: 1.7,
        allowTouchMove: false,
        /*
        noSwiping: true,
        noSwipingClass: 'team-slider__slide_swipe-block',*/
        coverflowEffect: {
            rotate: 50,
            stretch: 0,
            depth: 100,
            modifier: 1,
            slideShadows: false,
        },    
        lazy:{
            loadOnTransitionStart: true,
            loadPrevNext: true
        },
        navigation: {
            nextEl: '.team-slider__arrows-next',
            prevEl: '.team-slider__arrows-prev'
        },
        breakpoints: {
            0: {
                spaceBetween: 25,
                slidesPerView: 1.2
            },
            468: {
                spaceBetween: 25,
                slidesPerView: 1.5
            },
            768: {
                spaceBetween: 45,
                slidesPerView: 1.5
            },
            1270: {
                spaceBetween: 100
            },
        },
        history: {
            root: APP_PATH,
            key: "team",
        }
    });

    document.querySelector(".team-slider").classList.remove("team-slider_load");

    const teamButtons = document.querySelectorAll(".team-slider__arrows");
    const relizesContainer = document.querySelector("#team_relizes");
    const pagination = document.querySelector(".pagination");

    let prevId = document.querySelector(".team-slider__slide.swiper-slide-active").dataset.id;
    let isPrev = false,isEnd = false;
    
    swiper.on('slideChangeTransitionEnd', async () => {
        try {
            await changeSlide();
            
        } catch(e) {
            throw new Error(e);
        }
    })

    const changeSlide = async () => {     
        const current = document.querySelector(".team-slider__slide.swiper-slide-active");
        const currentId = current.dataset.id;

        if(currentId === prevId) return;
        prevId = currentId;
        current.classList.add("team-slider__slide_swipe-block");
        teamButtons.forEach((btn) => btn.disabled = true);
        relizesContainer.classList.add("team-relizes__hidden");

        const data = {
            id: currentId,
            _token: document.querySelector('meta[name="_token"]').content,
        }
        const relizeData = await getRelizePerson(data);
        const relizes = relizeData.relizes;
        const pagin = relizeData.pagination;

        relizesContainer.classList.remove("team-relizes__hidden");
        relizesContainer.querySelector(".context-panel__title h3").innerHTML = current.dataset.name;

        let result = "";
        //&& relizes.length > 0
        if(relizes) {
            relizes.forEach((relize) => {
                result += createSeria(relize);
            })
            relizesContainer.querySelector(".serias-block").innerHTML = result;
            lazyLoadStart();
        }
        
        setPagination(pagin);
        await deley(300);
        current.classList.remove("team-slider__slide_swipe-block");
        teamButtons.forEach((btn) => btn.disabled = false);

    }

    const setPagination = (pagin) => {
        const pagesCount = pagin.last_page;

        if(pagesCount > 1) {
            pagination.querySelector(".pagination__current").innerHTML = "1";
            pagination.querySelector(".pagination__last-page").innerHTML = pagesCount;
            pagination.classList.remove("pagination_hidden");
            pagination.querySelector(".pagination__link-next").href = `${window.location.href}?page=${2}`;
        } else {
            pagination.classList.add("pagination_hidden");
        }
    }
    
    const getRelizePerson = async (data) => {
        const relizeData = await instance.post(`/team_process`, data);
        return relizeData;
    }
    /*
    swiper.on('slideNextTransitionEnd', async () => {
        if(isEnd) return;
        const team = document.querySelectorAll(".team-slider__slide");
        const currentId = team[team.length - 1].dataset.id;
        await addSlides(currentId);
    })
    swiper.on('slidePrevTransitionEnd', async () => {
        if(isPrev) return;
        const team = document.querySelectorAll(".team-slider__slide");
        const currentId = team[0].dataset.id;
        await addSlides(currentId, false);
    })*/

    const addSlides = async (id, isNext = true) => {
        const data = {
            id,
            _token: document.querySelector('meta[name="_token"]').content,
        }
        const voicers =  await addVoicers(data, isNext);
        if(!voicers || voicers.length === 0) {
            isNext ? isEnd = true : isPrev = true;
            return;
        }
        voicers.forEach((voice) => {
            const slide = newSlide(voice);
            isNext ? swiper.appendSlide(slide) : swiper.prependSlide(slide);
        });
    }

    const addVoicers = async (data, isNext = true) => {
        const voiceData = await instance.post(isNext ? `/team_next` : `/team_prev` , data);
        return voiceData.voicers;
    }

    const newSlide = (data) => {
        return `<div class="team-slider__slide swiper-slide" data-id="${data.id}" data-name="${data.name}" data-history="${data.id}">
            <div class="team-slider__image-container">
                <img class="team-slider__image" src="${voicerImage(data.image)}" alt="">
            </div>
            <div class="team-slider__content">
                <h2 class="team-slider__title">${data.name}</h2>
                <span class="team-slider__status">${data.status || ""}</span>
                <p class="team-slider__description">
                    ${data.description || "..."} 
                </p>
            </div>
            <!--<img class="team-slider__image swiper-lazy" data-src="images/barakamon.jpg" src="images/5x5.png" alt="">-->
            <div class="head-slider__preloader swiper-lazy-preloader"></div>
        </div>`
    }

    function voicerImage(image) {
        return getAssetPath(image ? `/images/voicers/${image}` : `/images/users/default-user-image.png`);
    }
    
    function createSeria(data) {
        return `
        <div class="serias-block__item" data-id = "${data.id}">
            <a href="/releases/${data.original_title}">
                <div class = "serias-block__image-container">
                    <img class="serias-block__image lazy" data-src="${getAssetPath(`/images/animes/${data.image}`)}" oncontextmenu="return false;" src="images/5x5.png" alt="">
                    <div class="preloader"><div class="preloader__block">
                        <div class="preloader__spin"></div>
                        </div>
                    </div>
                </div>
                <div class="serias-block__title">
                    ${data.title}
                </div>
            </a>
        </div>`;
    }
})


