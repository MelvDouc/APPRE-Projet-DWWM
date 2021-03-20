// ====================
// Display customer comments
// ====================

const boutonVoirCommentaires = document.querySelector("#voir-commentaires > button");

const basculerCommentaires = () => {
    const commentairesClients = document.getElementById("commentaires-clients");
    switch (commentairesClients.style.display) {
        case "none":
            commentairesClients.style.display = "initial";
            boutonVoirCommentaires.innerText = "Cacher les commentaires clients";
            break;
        case "initial":
            commentairesClients.style.display = "none";
            boutonVoirCommentaires.innerText = "Voir les commentaires clients";
            break;
    }
}

boutonVoirCommentaires.addEventListener("click", basculerCommentaires);
