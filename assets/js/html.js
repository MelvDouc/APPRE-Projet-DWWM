// import {BookCard} from './classes/BookCard.js';
import { FormField, SubmitButton } from "./classes/FormComponents.js";

const loginForm = document.getElementById("formulaire-connexion"),
signupForm = document.getElementById("formulaire-inscription"),
contactForm = document.getElementById("formulaire-contact"),
requestNewPasswordForm = document.getElementById("formulaire-reinit"),
loginFormData = {
    username: {
        labelText: "Nom d'utilisateur ou adresse email",
        labelTitle: "",
        type: "text",
        id: "id_connexion",
        required: true
    },
    password: {
        labelText: "Mot de passe",
        labelTitle: "Doit contenir de 8 à 20 caractères dont au moins une minuscule, une majuscule, un chiffre et un signe de ponctuation",
        type: "password",
        id: "mdp",
        required: true
    }
},
signupFormData = {
    username: {
        labelText: "Nom d'utilisateur",
        labelTitle: "",
        type: "text",
        id: "pseudo",
        required: true,
        placeholder: "Pas de tiret au début ni à la fin"
    },
    email: {
        labelText: "Adresse email",
        labelTitle: "",
        type: "email",
        id: "courriel",
        required: true
    },
    password: {
        labelText: "Mot de passe",
        labelTitle: "Doit contenir de 8 à 20 caractères dont au moins une minuscule, une majuscule, un chiffre et un signe de ponctuation",
        type: "password",
        id: "mdp",
        required: true,
        placeholder: "De 8 à 20 caractères"
    },
    confirmPassword: {
        labelText: "Confirmer le mot de passe",
        labelTitle: "",
        type: "password",
        id: "confirmation_mdp",
        required: true
    }
},
contactFormData = {
    firstName: {
        labelText: "Prénom",
        labelTitle: "",
        type: "text",
        id: "prenom",
        required: true
    },
    lastName: {
        labelText: "Nom de famille",
        labelTitle: "",
        type: "text",
        id: "nom_de_famille",
        required: true
    },
    username: {
        labelText: "Nom d'utilisateur (si vous avez un compte)",
        labelTitle: "",
        type: "text",
        id: "pseudo",
        required: false
    },
    email: {
        labelText: "Adresse email",
        labelTitle: "",
        type: "email",
        id: "courriel",
        required: true
    }
},
requestNewPasswordFormData = {
    email: {
        labelText: "Votre adresse email",
        labelTitle: "",
        type: "email",
        id: "courriel",
        required: true
    }
};

const insertFormFields = (form, formData) => {
    if(form != null) {
        Object.values(formData).slice().reverse().forEach(data => {
            let formField = new FormField(...Object.values(data));
            form.insertAdjacentElement("afterbegin", formField);
        });
        form.insertAdjacentElement("beforeend", new SubmitButton());
    }
}

insertFormFields(loginForm, loginFormData);
insertFormFields(signupForm, signupFormData);
insertFormFields(contactForm, contactFormData);
insertFormFields(requestNewPasswordForm, requestNewPasswordFormData);