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

const fileUploads = document.querySelectorAll(".file-upload");

fileUploads.forEach((upload) => {
    const input = upload.querySelector("input[type=file].file-upload__input");
    const image = upload.querySelector("img.file-upload__img")

    if(!input || !image) return;

    input.addEventListener("change", (event) => {
        preview(event.target.files[0],image);
    })
})

function preview(file,img) {
    if ( file.type.match() ) {
        var reader = new FileReader(), img;

        reader.addEventListener("load", function(event) {
            console.log(event.target.result);
            img.src=event.target.result;
        });

        reader.readAsDataURL(file);
    }
}