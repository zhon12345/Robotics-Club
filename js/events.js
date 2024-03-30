function popupToggle() {
	const popup = document.querySelector(".popup");

	popup.classList.toggle("active");
}

function toggleContent(element) {
	var eventItem = element.closest(".event-item");
	var content = eventItem.querySelector(".event-content");

	if (content.style.display === "none" || content.style.display === "") {
		content.style.display = "block";
		element.textContent = "Less";
		eventItem.classList.add("enlarge");

		document.addEventListener("click", closeEnlargedItem);
	} else {
		content.style.display = "none";
		element.textContent = "More";
		eventItem.classList.remove("enlarge");

		document.removeEventListener("click", closeEnlargedItem);
	}
}

function closeEnlargedItem(event) {
	var enlargedItem = document.querySelector(".enlarge");

	if (enlargedItem && !enlargedItem.contains(event.target)) {
		var content = enlargedItem.querySelector(".event-content");
		var moreButton = enlargedItem.querySelector(".more");
		content.style.display = "none";
		moreButton.textContent = "More";
		enlargedItem.classList.remove("enlarge");
		document.removeEventListener("click", closeEnlargedItem);
	}
}
