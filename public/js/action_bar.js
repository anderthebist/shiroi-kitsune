// Navbar functions
const actionBar = document.querySelector("#action_bar");
const navBtn = document.querySelector("#nav_btn");
const blackAction = document.querySelector("#black-action");

navBtn.addEventListener("click", () => {
    actionBar.classList.toggle("active");
    navBtn.classList.toggle("active");
    blackAction.classList.toggle("active");
})

blackAction.addEventListener("click", (event) => {
    if(event.target.id == "black-action"){
        actionBar.classList.remove("active");
        navBtn.classList.remove("active");
        blackAction.classList.remove("active");
    }

})

const navContent = document.querySelector("#nav_content");
const navSearchPanel = document.querySelector("#nav_search_panel");
const navSearchBtn = document.querySelector("#nav_search_btn");
const navBackBtn = document.querySelector("#nav_back_btn");
const navSearch = document.querySelector("#nav_search");

navSearchBtn.addEventListener("click", () => {
    if(navContent.classList.contains("active"))
        navContent.classList.remove("active");
    navSearchPanel.classList.add("active");
    navSearch.focus();
})

navBackBtn.addEventListener("click", () => {
    if(navSearchPanel.classList.contains("active"))
        navSearchPanel.classList.remove("active");
    navContent.classList.add("active");
})

// Auth and register
const authBlockItems = document.querySelectorAll("#auth_modal .tab__item");
const authForms = document.querySelectorAll("#auth_modal .tab__content");

let prevItemActive = 0;

authBlockItems.forEach((elem,index) => {
    elem.addEventListener("click", () => {
        authBlockItems[prevItemActive].classList.remove("tab__item_active");  
        elem.classList.add("tab__item_active");

        authForms[prevItemActive].classList.remove("tab__content_active");
        authForms[index].classList.add("tab__content_active");
        prevItemActive = index;
    })
})

const auth = async (uri,data,errorElement) => {
    const userData = await instance.post(`/auth${uri}`, data);

    if(userData.resultCode == 0) {
        errorElement.innerHTML = "";
        window.location.reload(false); 
        return;
    }
    errorElement.innerHTML = userData.errors[0];
}

const formsSubmiting = async (event, formData, url, errorElement) => {
    try {
        event.preventDefault();
        event.target.auth_submit.classList.add("auth-block__btn_hidden");
        await auth(url,formData,errorElement); 
        event.target.auth_submit.classList.remove("auth-block__btn_hidden");
    } catch (e) {
        throw new Error(e.message);
    }
}

const authForm = document.querySelector("#auth");
const authError = document.querySelector("#auth_error");

authForm.addEventListener("submit",async (event) => {
    const dataForm = {
        email: event.target.email.value,
        password: event.target.password.value,
        _token: document.querySelector('meta[name="_token"]').content,
    }
    await formsSubmiting(event, dataForm, "/auth_process",authError);
})

const registerForm = document.querySelector("#register");
const registerError = document.querySelector("#register_error");

registerForm.addEventListener("submit",async (event) => {
    const dataForm = {
        name: event.target.name.value,
        email: event.target.email.value,
        password: event.target.password.value,
        password_confirmation: event.target.password_confirmation.value,
        _token: document.querySelector('meta[name="_token"]').content,
    }
    await formsSubmiting(event, dataForm, "/register_process", registerError);
})

const showPassword = document.querySelector("#show_password");
const authPasswordInput = document.querySelector("#auth_password");

showPassword.addEventListener("change", () => {
    if(showPassword.checked){
        authPasswordInput.type = "text";
        return;
    }
    authPasswordInput.type = "password";
})