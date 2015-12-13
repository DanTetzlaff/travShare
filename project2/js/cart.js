window.addEventListener('load', init);

function init() {
	var total = document.getElementById("total");
	total.style.color = "red";
}

function select(e)
{
	var sel = document.createElement('option');
	sel.setAttribute('');
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