const swiper = new Swiper('.player__slider',{
    freeMode: true,
    slidesPerView: 'auto',
    mousewheel: true,
    navigation: {
        nextEl: '.player__arrows-next',
        prevEl: '.player__arrows-prev'
    },
    breakpoints: {
        // when window width is >= 320px
        0: {
            slidesPerGroup: 3
        },
        768: {
            slidesPerGroup: 8,
        },
    }
});

const animeId = document.querySelector("#anime_id").value;

// Video links

const vidoe = document.querySelector("iframe#video_player");
const videoItems = document.querySelectorAll("div[data-iframe-link]");
let activeLink = 0;

if(videoItems && videoItems.length > 0) {
    const seria = localStorage.getItem(`seria${animeId}`) || videoItems[0].innerHTML.trim();

    videoItems.forEach((item, index) => {
        if(item.innerHTML.trim() === seria) changeVideo(item, index);

        item.addEventListener("click", () => {
            if(!item.classList.contains("player__item_active"))
                changeVideo(item, index);
        })
    })

    function changeVideo(item, index) {
        const link = item.dataset.iframeLink;
        //&& index !== activeLink
        if(link && vidoe) {
            vidoe.src = link;
        
            videoItems[activeLink].classList.remove("player__item_active");
            item.classList.add("player__item_active");
            activeLink = index;

            localStorage.setItem(`seria${animeId}`,item.innerHTML.trim());
        }
    }
}
// Empty coment
const formComent = document.querySelector("#send_coment");
const emptyComent = document.querySelector("#empty_coment");

function checkEmpty() {
    const coments = document.getElementsByClassName("coment");

    if(coments && coments.length > 0) {
        emptyComent.style.display = "none";
        return;
    }
    emptyComent.style.display = "block";
}

// Answer

const answers = document.getElementsByClassName("coment__answer");
const answerUser = document.querySelector("#answer_user");
const answerClose = document.querySelector("#answer_close");

[...answers].forEach((answer) => {
    answer.addEventListener("click", () => {
        if(!answer.dataset.answer || !answer.dataset.answerName) return;
    
        formComent.answer.value = answer.dataset.answer;
        if(answerUser) {
            answerUser.classList.add("form-coment__answer_active");
            
            const answerName = answerUser.querySelector("#answer_name");
            if(answerName) answerName.innerHTML = `@${answer.dataset.answerName}`;
        }
            
        scrollToSmoothly(formComent.offsetTop - 20);
    })
})

if(answerClose) {
    answerClose.addEventListener("click", () => {
        formComent.answer.value = "";
        if(answerUser) answerUser.classList.remove("form-coment__answer_active");
    })
}

// Scroll smothly

function scrollToSmoothly(position, duration = 2) {
    if (isNaN(position)) {
      throw new Error("Position is undefined");
    }

    let currentPos = window.scrollY || window.screenTop;
    const to = position >= 0 ? position : 0;
    const isUp = currentPos < to;

    const smoth = setInterval(() => {
        currentPos = isUp ? currentPos + 10 : currentPos - 10;
        window.scrollTo(0, currentPos);
        if (isUp ? currentPos >= to : currentPos <= to) {
            clearInterval(smoth);
        }
    }, duration);
}


const comentList = document.querySelector("#coment_id");
const coments = document.getElementsByClassName("coment");

const comentIdHidden = document.querySelector("#del_coment_id");

document.addEventListener("click", (event) => {
    if(event.target.className === "coment__settings") {
        const delBtn = document.getElementById(event.target.id);
        if(!delBtn.dataset.modalId || !comentIdHidden) return;
        const modalContent = document.querySelector(delBtn.dataset.modalId);

        if(modalContent) {
            modalContent.classList.add("modal_active");
        }
        comentIdHidden.value = delBtn.dataset.id | "";
    }
})

// Delete coments

const deleteComentBtn = document.querySelector("#delete_coment");
const closeBtn = document.querySelector("#close_model_btn");
const deleteAlert = document.querySelector("#delete_alert");

const delBtns = document.getElementsByClassName("coment__settings");

closeBtn.addEventListener("click", () => {
    comentIdHidden.value = "";
    deleteAlert.classList.remove("modal_active");
})

deleteComentBtn.addEventListener("click", async () => {
    try {
        const comentId = comentIdHidden.value;
        if(!comentId) return;
        const isDelete = await delComent(comentId);

        if(!isDelete) throw new Error("Deleting error"); 
        const comentIndex = [...coments].findIndex((elem) => comentId === elem.dataset.id);
        if(comentIndex === -1) return;

        comentIdHidden.value = "";

        const coment = coments[comentIndex];
        const answer = coment.nextElementSibling;
        if(answer && answer.classList.contains("answer")) answer.remove()
        coment.remove();
        deleteAlert.classList.remove("modal_active");

        checkEmpty();
    } catch (e) {
        new Error(e);
    }
})

const delComent = async (id) => {
    const data = await instance.get(`/coment/delete/${id}`);
    return data;
}

if(formComent) {
    formComent.addEventListener("submit", async (event) => {
        try {
            event.preventDefault();
    
            const text = event.target.text_coment;
            const answer = event.target.answer;
            const btnComent = event.target.btn_coment;
            
            if(!text.value && text.value.trim() > 0) return;
            let container = comentList;
            btnComent.disabled = true;
    
            const dataComent = {
                _token: document.querySelector('meta[name="_token"]').content, 
                text: text.value,
                anime_id: animeId
            }
    
            const isAnswer = answer && answer.value;
    
            if(isAnswer) {
                dataComent.parent_id = answer.value;
                container = document.querySelector(`#answer${answer.value}`);
                //if(!container) return;
            }
            const comenData = await sendComent(dataComent);
    
            const coment = {
                id: comenData.id,
                username: comenData.user.name,
                image: comenData.user.image,
                text: comenData.text,
                date: dateNowFormat()
            }
            addComent(container, coment);
            checkEmpty();
    
            answerUser.classList.remove("form-coment__answer_active");
            if(isAnswer) scrollToSmoothly(container.offsetTop - 20);
    
            text.value = "";
            answer.value = "";
            btnComent.disabled = false;
        } catch(e) {
            throw new Error(e);
        }
    })
}

const sendComent = async (data) => {
    const newComent = await instance.post(`/coment/send`, data);
    return newComent;
}

function dateNowFormat() {
    const now = new Date();

    const dd = digitWithZero(now.getDate());
    const mm = digitWithZero((now.getMonth() + 1));
    const YY = now.getFullYear();

    return `${dd}.${mm}.${YY}`;
}

function digitWithZero(digit) {
    return digit > 10 ? digit : `0${digit}`;
}

function addComent(container, coment) {
    container.insertAdjacentHTML('afterbegin', newComent(coment));
}

function newComent(data) {
    return `
    <div class="coment" data-id = "${data.id}">
        <a href="${APP_PATH}/users/${data.username}">
            <div class="coment__container-img">
                <img class="coment__image" src="${getUserImagePath(`/images/users/${data.image}`)}" alt="">
            </div>
        </a>

        <div class="coment__content">
            <div class="coment__header">
                <a href="${APP_PATH}/users/${data.username}">
                    <div class="coment__username">
                        ${data.username}
                    </div>
                </a>
                <div class="coment__header-right">
                    <div class="coment__date">
                        ${data.date}
                    </div>
                    <div class="coment__settings" id = "del_coment${data.id}" data-id="${data.id}" data-modal-id = "#delete_alert">
                    </div>
                </div>
            </div>
            <div class="coment__body">
                <p class="coment__text">
                    ${data.text}
                </p>
            </div>
        </div>
    </div>
    `;
}