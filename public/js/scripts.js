// Deley

const deley = (mili) => {
    return new Promise(res => setTimeout(res, mili));
}

// Outclick element

const outClick = (event,classElements ,callback) => {
    let contain = false;
    for(let i = 0;i<classElements.length;i++) {
        if(event.composedPath().includes(classElements[i])) {
            contain = true;
            break;
        }
    }

    if(!contain) {
        callback();
    }
}

function getAssetPath(uri) {
    return `${APP_ASSETS_PATH}${uri}`;
}

// Lazy loading

lazyLoadStart();
window.addEventListener("scroll", () => {
    lazyLoadStart();
})

function imagePostion(image) {
    return (image.getBoundingClientRect().top + window.scrollY);
}

function isImageScroll(image) {
    return (window.scrollY + 300) > imagePostion(image) - document.documentElement.clientHeight
}

function lazyLoadStart() {
    const images = document.querySelectorAll("img[data-src].lazy");

    images.forEach((image) => {
        if(isImageScroll(image) && image.dataset.src) {
            image.src = image.dataset.src;
            image.removeAttribute("data-src");
        }
    })
}

// Modals
const modalActivated = document.querySelectorAll(".modal-activated");
const modals = document.querySelectorAll(".modal");

modalActivated.forEach((elem) => {
    elem.addEventListener("click", () => {
        const modal = document.querySelector(elem.dataset.modalId);
        if(modal)
            modal.classList.add("modal_active");
    })
})

modals.forEach((elem) => {
    elem.addEventListener("click", (event) => {
        if(event.target.id === elem.id)
            elem.classList.remove("modal_active");
    })
})

// Search
const search = document.querySelectorAll(".search__input");

search.forEach((elem) => {
    elem.addEventListener("input", async () => {
        try {
            const searchList = document.querySelector(elem.dataset.listSearch);
            const token = document.querySelector('meta[name="_token"]').content;
            if(!searchList) return;
            searchList.innerHTML = "";
            if(elem.value.length < 3) return ; 
            const searchData = {
                value: elem.value
            }
            const relizes = await searchRelize(searchData);

            if(relizes && relizes.length > 0) {
                let result = "";
                relizes.forEach((relize) => {
                    result += searchItem(relize.id,relize.image,relize.title, relize.original_title,relize.description);
                })
                searchList.innerHTML = result;
            }
        } catch (e) {
            console.log(e);
        }
    })
})


document.addEventListener("click", (event) => {
    const searchItems = document.querySelectorAll(".search__item");

    outClick(event, searchItems,() => {
        const searchLists = document.querySelectorAll(".search__list");
        searchLists.forEach((list) => list.innerHTML = "")
    });
})

const searchItem = (id,image,title, original,description) => {
    return `<a href = "/releases/${original}">
        <div class="search__item" data-id = "${id}">
            <div class="search__image-container">
                <img class="search__image" src="${getAssetPath(`/images/animes/${image}`)}" alt="">
            </div>
            <div class="search__body">
                <div class="search__title">${title}</div>
                <div class="search__description">
                    ${description}
                </div>
            </div>
        </div>
    </a>`;
}

const searchRelize = async (data) => {
    const relizeData = await instance.post(`/releases/search`, data);
    return relizeData.relizes;
}