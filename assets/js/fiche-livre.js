// ====================
// Display customer comments
// ====================

const viewCommentsButton = document.querySelector("#view-comments > button");

const toggleComments = () => {
    const customerComments = document.getElementById("customer-comments");
    switch (customerComments.style.display) {
        case "none":
            customerComments.style.display = "initial";
            viewCommentsButton.innerText = "Cacher les commentaires clients";
            break;
        case "initial":
            customerComments.style.display = "none";
            viewCommentsButton.innerText = "Voir les commentaires clients";
            break;
    }
}

viewCommentsButton.addEventListener("click", toggleComments);
