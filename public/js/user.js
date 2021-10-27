const relizeSwiper = new Swiper('.relize-slider',{
    speed: 700,
    slidesPerGroup: 2,
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

const uploadImage = document.querySelector("#upload_image");
const profileImage = document.querySelector("#profile_image");
const actionUserImage = document.querySelector("#action_user-image");

uploadImage.addEventListener("change", async (event) => {
    try {
        const file = event.target.files[0];
        uploadImage.disabled = true;
        
        const formData = new FormData();
        formData.append("image", file);

        const image = await uploadUserImage(formData);
        const path = getUserImagePath(`/images/users/${image}`);

        uploadImage.disabled = false;
        if(profileImage && actionUserImage) {
            profileImage.src = path;
            actionUserImage.src = path; 
        }
    } catch(e) {
        throw new Error(e);
    }
})

const uploadUserImage = async (data) => {
    const imageData = await instance.post(`/users/upload_image`, data);

    return imageData.image;
}

const editAlert = document.querySelector("#edit_alert");
const editError = document.querySelector("#edit_error");
const editBtn = document.querySelector("#submit_edit")
const userName = document.querySelector("#user_name");

const editAlertModal = document.querySelector("#edit_name_modal");

editAlert.addEventListener("submit", async (event) => {
    try {
        event.preventDefault();
        let name = event.target.edit_name.value;
    
        if(!name || !name.trim().length || name.trim() === userName.innerHTML.trim()) return;
        const data = {
            name: name.trim()
        }
    
        editBtn.classList.add("edit-alert__btn_hidden");
        const newName = await editNameUser(data);
        
        window.location.href = `${APP_PATH}/users/${newName}`; 
    } catch(e) {
        throw new Error(e);
    }
})

const editNameUser = async (data) => {
    const userData = await instance.post(`/users/edit_name`, data);
    if(userData.resultCode === 0)   return userData.name;

    editError.innerHTML = userData.errors[0];
    editBtn.classList.remove("edit-alert__btn_hidden");
    throw new Error("Bad request");
}