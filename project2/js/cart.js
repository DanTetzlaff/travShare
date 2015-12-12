window.addEventListener('load', init);

function init() {
	var items = document.querySelectorAll(".cartItem select");
	for(i = 0; i < items.length; i++)
	{
		items[i].addEventListener("change", recompute);
		//images[i].addEventListener("mouseout", removeImg);
	}
}

function recompute(e)
{
	this.setAttribute('selected', 'selected');
	/**var img = document.createElement('img');
	img.src = this.src;
	img.setAttribute('class', 'bigImg');
	this.parentNode.appendChild(img);**/
}

function removeImg(e)
{
	this.parentNode.removeChild(this.parentNode.lastChild);
}