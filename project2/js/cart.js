window.addEventListener('load', init);

function init() {

	getTotals();
}

function getTotals()
{
	var total = document.getElementById("total");
	total.style.color = "red";
	
<<<<<<< HEAD
	//test values
	subtotal = getRunningTotal();
	frames = parseInt(document.getElementById('frames'));
	getShippingCosts(subtotal, frames);
	//end test
	
=======
>>>>>>> origin/master
	var standard = document.getElementById("ship1");
	setshipCost(standard);
	var express = document.getElementById("ship2");
	setshipCost(express);	
}

<<<<<<< HEAD
function getRunningTotal()
{
	var e = document.getElementById("runningTotal").innerHTML;
	var subtotal = e.replace("$", '');
	return subtotal;
}

//updates the sum total of the cart
function updateTotal(shipCost)
{
	subtotal = getRunningTotal();
	total = parseInt(subtotal) + parseInt(shipCost);
	document.getElementById("total").innerHTML = '$' + total;
}

=======
//updates the sum total of the cart
function updateTotal(shipCost)
{
	var e = document.getElementById("runningTotal").innerHTML;
	var subtotal = e.replace("$", '');
	total = parseFloat(subtotal) + parseFloat(shipCost);
	document.getElementById("total").innerHTML = '$' + total;
}

>>>>>>> origin/master
//adds event listeners to the shipping radio options
function setshipCost(method)
{
	var v = method.value;
	method.addEventListener("click", setCost);
}

//gets the shipping cost of the cart in total
function setCost(e)
{
	var elem = document.getElementById("shipJs");
	var shipCost = this.value;
	elem.innerHTML = '<strong> $' + shipCost + '</strong>';
	updateTotal(shipCost);
}

function getShippingCosts(subtotal, frames)
{
	var standard = 0;
	var express = 0;
	var finalTotal = subtotal;
	if (subtotal > 300) { } //everything is free
	else if (frames > 10)
	{
		standard = 30;
		express = 45;
	}
	else if (frames < 10 && frames > 0)
	{
		standard = 15;
		express = 25;
	}
	else if (frames == 0)
	{
		standard = 5;
		express = 15;
	}
	
	if (subtotal > 100) { standard = 0;}
	finalTotal += standard;
	
	var stan = document.getElementById('ship1');
	stan.setAttribute('value', standard);
<<<<<<< HEAD
	stan.innerHTML.replace('($)', '$ ' + standard);
	
	var exp = document.getElementById('ship2');
	exp.setAttribute('value', express);
	exp.innerHTML.replace('($)', '$ ' + express);
	
=======
	setShipCost(stan);
	stan.innerHTML.replace('($)', '$ ' + standard);
	
>>>>>>> origin/master
}