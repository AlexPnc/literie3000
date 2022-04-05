function hide() {
    let item1 = document.querySelectorAll(".item__erase");
    item1.forEach(item => {
        if (item.className === "item__erase") {
            item.className += " hide";
        } else {
            item.className = "item__erase";
        }
    });
    
    let item2 = document.getElementById("erase2");
    if (item2.className === "presentation-btn") {
        item2.className += " hide";
    } else {
        item2.className = "presentation-btn";
    }

    let item3 = document.getElementById("erase3");
    if (item3.className === "add-btn") {
        item3.className += " hide";
    } else {
        item3.className = "add-btn";
    }

    let item4 = document.getElementById("erase4");
    if (item4.className === "tool-btn") {
        item4.className += " show";
    } else {
        item4.className = "tool-btn";
    }
}