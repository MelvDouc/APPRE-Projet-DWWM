class FormDiv {
    constructor(className) {
        this.className = className;

        let div = document.createElement('div');
        div.classList.add(this.className);

        return div;
    }
}

export class FormField {
    constructor(labelText, labelTitle, inputType, inputId, requiredField, inputPlaceholder = "") {
        this.labelText = labelText;
        this.labelTitle = labelTitle;
        this.inputType = inputType;
        this.inputId = inputId;
        this.requiredField = requiredField;
        this.inputPlaceholder = inputPlaceholder;
        
        let formField = new FormDiv("champ-formulaire");
        let label = document.createElement("label");
        let input = document.createElement("input");

        label.setAttribute("for", this.inputId);
        label.innerText = this.labelText;
        if(this.labelTitle != "") label.title = this.labelTitle;
        if(this.requiredField) label.classList.add("champ-requis");

        input.type = this.inputType;
        input.id = this.inputId;
        input.name = this.inputId;
        input.placeholder = this.inputPlaceholder;
        input.required = this.requiredField;

        formField.append(label, input);

        return formField;
    }
}

export class SubmitButton {
    constructor() {
        let formSubmit = new FormDiv("validation-formulaire");

        let button = document.createElement("button");
        button.type = "submit";
        button.innerText = "Valider";

        formSubmit.appendChild(button);

        return formSubmit;
    }
}