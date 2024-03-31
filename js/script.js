// register.php
function popupToggle() {
	const popup = document.querySelector('.popup');

	popup.classList.toggle('active');
}

function toggleContent(element) {
	var newsItem = element.closest('.news-item');
	var content = newsItem.querySelector('.news-content');

	if (content.style.display === 'none' || content.style.display === '') {
		content.style.display = 'block';
		element.textContent = 'Less';
		newsItem.classList.add('enlarge');

		document.addEventListener('click', closeEnlargedItem);
	} else {
		content.style.display = 'none';
		element.textContent = 'More';
		newsItem.classList.remove('enlarge');

		document.removeEventListener('click', closeEnlargedItem);
	}
}

function closeEnlargedItem(event) {
	var enlargedItem = document.querySelector('.enlarge');

	if (!enlargedItem.contains(event.target)) {
		var content = enlargedItem.querySelector('.news-content');
		var moreButton = enlargedItem.querySelector('.more');
		content.style.display = 'none';
		moreButton.textContent = 'More';
		enlargedItem.classList.remove('enlarge');
		document.removeEventListener('click', closeEnlargedItem);
	}
}
