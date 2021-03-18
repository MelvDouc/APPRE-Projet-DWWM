export class BookCard {
	constructor(title, author, summary, price) {
		this.title = title;
		this.author = author;
		this.summary = summary;
		this.price = price;

		let card = document.createElement("DIV");
		div.classList.add("book");

		let bookTitle = document.createElement("H3");
		bookTitle.innerText = this.title;

		let bookAuthor = document.createElement("DIV");
		bookAuthor.classList.add("author");

		let bookSummary = document.createElement("P");
		bookSummary.classList("summary");

		let bookPrice = document.createElement("DIV");
		bookPrice.classList.add("price")

		let link = document.createElement("A");
		a.innerText = "Fiche détaillée";

		card.append(bookTitle, bookAuthor, bookSummary, bookPrice, link);

		return card;
	}
}