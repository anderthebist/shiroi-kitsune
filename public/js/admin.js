$(".mult_select").chosen();

const deleteBtn = document.querySelectorAll(".delete_btn");

deleteBtn.forEach((elem) => {
    elem.addEventListener("click",(event) => {
        if(!confirm("Подтвердите действие")){
            event.preventDefault();
        }
    })
})

const fileInputs = document.querySelectorAll(".custom-file-input");
fileInputs.forEach((loader) => {
    loader.addEventListener("change",(event) => {
        loader.nextElementSibling.innerHTML = event.target.files[0].name;
    })
})