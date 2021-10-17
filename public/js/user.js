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
        const path = getUserImagePath(image);

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