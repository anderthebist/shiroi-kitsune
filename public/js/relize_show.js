
const ratings = document.querySelectorAll(".rating");

ratings.forEach((rating) => {
    const raitingItems = rating.querySelectorAll(".rating__item");

    const raitingActive = rating.querySelector(".rating__active");
    const raitingValue = rating.querySelector(".rating__value");
    
    if(!rating.dataset || !raitingActive || !raitingValue) return;
    changeRatingValue();
    
    raitingItems.forEach((raitingItem) => {
        raitingItem.addEventListener("mouseenter", () => {
            if(rating.dataset.marked) return;
            raitingActive.style.opacity = ".85";
            changeRatingValue(raitingItem.value);
        })

        raitingItem.addEventListener("mouseleave", () => {
            raitingActive.style.opacity = "1";
            changeRatingValue();
        })

        raitingItem.addEventListener("click", async () => {
            try {
                const mark = raitingItem.value;
                const anime_id = rating.dataset.anime;
                const isMarked = rating.dataset.marked;
                
                if(!mark || !anime_id || isMarked) return;
                
                const markData = {
                    mark,
                    anime_id,
                    _token: document.querySelector('meta[name="_token"]').content,
                }
                rating.classList.add("rating_hidden");
                const resultMark = await setMark(markData);

                changeRatingValue(resultMark)
                raitingValue.innerHTML = resultMark;
                rating.classList.remove("rating_hidden");

                rating.dataset.marked = true;
            } catch(e) {
                throw new Error(e);
            }
        })
    })

    function changeRatingValue(value = Number(raitingValue.innerHTML)) {
        const procentWidth = (value * 100) / 5;
  
        raitingActive.style.width = `${procentWidth}%`;
    }
})

const setMark = async (data) => {
    const mark = await instance.post(`/marks/create`, data);
    return mark.resultMark;
}