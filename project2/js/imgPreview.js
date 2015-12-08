/*
Author: Daniel Tetzlaff
Created: November 2015
Version: 1.1
	- adjusted to handle removing preview image in assignment 3 case
Makes handlers and shows/hides image previews on a mouse hovering over a thumbnail
*/


window.addEventListener('load', imageHandler); // check to see if page has loaded, begin running once page is loaded

// make event handlers for mouseover and mouseout events that occur on each image on the page
function imageHandler() {
	var images = document.querySelectorAll(".thumbImg");
	for (i=0; i < images.length; i++) {
		images[i].addEventListener("mouseover", showImage);
		images[i].addEventListener("mouseout", removeImage);
	}
}

// displays the preveiw image when mouseover event occurs
function showImage(e) {
	var img = document.createElement('img');
	var pathA = this.src; // grab source from the original image
	
	 // break path up from original to get the file name
	var path = "images/travel/small/" + pathA.split('/').pop();
	
	// make new path so we can use a small image for the preview
	img.setAttribute('src', path); 
	img.setAttribute('class', 'bigImg');
	// append this to the original image
	this.parentNode.appendChild(img); 
}

// remove the preview image by removing the last child appended to the image previews gparent node
function removeImage(e) {
	this.parentNode.removeChild(this.parentNode.childNodes[this.parentNode.childNodes.length -1]);
}
