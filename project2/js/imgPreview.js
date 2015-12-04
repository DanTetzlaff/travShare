window.addEventListener('load', imageHandler);

function imageHandler() {
	var images = document.querySelectorAll(".thumbImg");
	for (i=0; i < images.length; i++) {
		images[i].addEventListener("mouseover", showImage);
		images[i].addEventListener("mouseout", removeImage);
	}
}

function showImage(e) {
	var img = document.createElement('img');
	var pathA = this.src;
	var path = "images/travel/small/" + pathA.split('/').pop();
	img.setAttribute('src', path);
	img.setAttribute('class', 'bigImg');
	this.parentNode.parentNode.appendChild(img);
}

function removeImage(e) {
	this.parentNode.parentNode.removeChild(this.parentNode.parentNode.childNodes[this.parentNode.parentNode.childNodes.length -1]);
}
