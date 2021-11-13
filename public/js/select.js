const selects = document.querySelectorAll(".select");
const contnents = document.querySelectorAll(".select__content");
const dropdowns = document.querySelectorAll(".select__dropdown");

selects.forEach((select, index) => {
    const contnent = contnents[index];
    const dropdown = dropdowns[index];
    const selectPlaceholder = select.querySelector(".select__placeholder");
    const input = select.querySelector("input[type=hidden]");

    if(!contnent && !dropdown && !input) return;

    contnent.addEventListener("click", () => {
        const isActivated = !contnent.classList.contains("select__content_active");

        clearDrops();
        if(isActivated) contnent.classList.add("select__content_active");
    })

    const dropdownItems = dropdown.querySelectorAll(".select__dropdown-item");

    dropdownItems.forEach((item, itemIndex) => {
        item.addEventListener("click", () => {
            if(item.classList.contains("select__dropdown-item_selected")) return;
            selectPlaceholder.innerHTML = item.innerHTML;
            for(let i = 0;i<dropdownItems.length;i++) dropdownItems[i].classList.remove("select__dropdown-item_selected");
            item.classList.add("select__dropdown-item_selected");
            input.value = item.innerHTML;
            clearDrops();
        })
    })

    const dropdownCheck = select.querySelectorAll(".select__dropdown-check");
    changePlaveholder();

    dropdownCheck.forEach((check) => {
        check.addEventListener("click", () => {
            const checkbox = check.querySelector("input[type=checkbox].checkbox__check");
            checkbox.checked = !checkbox.checked;

            changePlaveholder();
        })
    });

    function changePlaveholder() {
        const checks = countCheck();

        if(!checks) {
            selectPlaceholder.innerHTML = select.dataset.selectName || "";
            return;
        }
        selectPlaceholder.innerHTML = `Выбранно ${checks} елемента`;
    }

    function countCheck() {
        let count = 0;
        for(let i = 0;i<dropdownCheck.length;i++) {
            if(dropdownCheck[i].querySelector("input[type=checkbox].checkbox__check").checked)
                count++;
        }
        return count;
    }
})

document.addEventListener("click", (event) => {
    outClick(event,selects ,clearDrops);
})

function clearDrops() {
    contnents.forEach((contnent) => contnent.classList.remove("select__content_active"));
}