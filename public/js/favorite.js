const favorites = document.querySelectorAll(".favorite");

favorites.forEach((favorite) => {
    favorite.addEventListener("click", async (event) => {
        try {
            if(!favorite.dataset.id) return;

            const isFav = favorite.dataset.fav;
            const anime_id = favorite.dataset.id;

            favorite.style.display = "none";
            const data = {
                anime_id: anime_id,
                _token: document.querySelector('meta[name="_token"]').content
            }
            const dataFavorite = !isFav ? await addFavorite(data) : await deleteFavorite(anime_id);

            favorite.style.display = "block";
            console.log(dataFavorite);

            const favImages = favorite.querySelectorAll(".favorite__like");
            if(favImages && favImages.length > 0) {
                favImages.forEach((image) => image.classList.remove("favorite__like_active"))
                favImages[isFav ? 1 : 0].classList.add("favorite__like_active"); 
            }

            favorite.setAttribute("data-fav", !isFav || "");
            
        } catch(e) {    
            throw new Error(e);
        }
    })
})

const addFavorite = async (data) => {
    const dataFavorite = instance.post("/favorite/create", data);

    return dataFavorite;
}

const deleteFavorite = async (id) => {
    console.log(id);
    const dataFavorite = instance.get(`/favorite/delete/${id}`);

    return dataFavorite;
}

