window.addEventListener('load', init);

/**
Author: Carille Mendoza
Version: 1.0
Created: December 2015
This file performs all the javascript functionality needed to autoupdate the cart
-- Totally works... just don't know how I made it work *pterodactyl screech*
Timecheck: &;19 and my life is not a total disaster
**/


function init() {

	var watch = document.getElementsByClassName("cartItem");
	for(w = 0; w < watch.length; w++)
	{
		watch[w].addEventListener("change", function(){
			var selOption = this.options[this.selectedIndex];
			//alert("itemIndex:" + w + "val" + selOption.value + "type" + selOption.getAttribute('class'));
			changeSelectedValue(selOption);
			getTotals();
		});
	}
	
	var qties = document.getElementsByClassName("quantities");
	for(d = 0; d < qties.length; d++)
	{
		qties[d].addEventListener("change", function(){getTotals()});
	}
}

function changeSelectedValue(selOption)
{
	var newVal = selOption.value;
	var newDesc = selOption.innerText;
	selOption.parentNode.options[0].value = parseInt(newVal);
	selOption.parentNode.options[0].innerText = newDesc;
	//alert(selOption.parentNode.options[0].innerText);
}

//computes for cart item total
function getTotals()
{
	var sizePrice = 0;
	var stockPrice = 0;
	var framePrice = 0;
	var qty = 0;
	
	var sizes = document.getElementsByClassName("sizes");
	var stocks = document.getElementsByClassName("stocks");
	var frames = document.getElementsByClassName("chosenFrame");
	var quantts = document.getElementsByClassName("quantities");
	var totals = document.getElementsByClassName("itemTotal");
	for(s = 0; s < sizes.length; s++)
	{
		size = parseInt(sizes[s].value);
		stock = parseInt(stocks[s].value);
		frame = parseInt(frames[s].value);
		quant = parseInt(quantts[s].value);
		
		sizePrice = calculateSize(size);
		stockPrice = calculateStock(size, stock);
		framePrice = calculateFrame(frame,size);
	
		total = computeItemTotal(sizePrice, stockPrice, framePrice, quant);
		totals[s].innerHTML = numeral(total).format('$0,0.00');
	}
	computeItemTotal(sizePrice, stockPrice, framePrice, qty);
	computeShopping();
}

//based on size price, frame price, quantity, and stock price, computes for item total
function computeItemTotal(sizePrice, stockPrice, framePrice, qty)
{
	return (sizePrice + stockPrice + framePrice) * qty;
}

//get the price of the picking the image size
function calculateSize(size)
{
	var sizePrice = 0;
	switch(size)
	{
		case 0: sizePrice = 0.5;
			break;
		case 1: sizePrice = 2.5;
			break;
		case 2: sizePrice = 6.0;
			break;
		case 3: sizePrice = 7.0;
			break;
	}
	
	return sizePrice;
}


//calculates stock price of item based on image size and what image stock was chosen by user
function calculateStock(size, stock)
{
	var stockPrice = 0;
	if(size == 0 || size == 1)
	{
		switch(stock)
		{
			case 0: stockPrice = 0;
				break;
			case 1: stockPrice = 0.50;
				break;
			case 2: stockPrice = 4.0;
				break;
		}
	}
	else if(size == 2)
	{
		switch(stock)
		{
			case 0: stockPrice = 0;
				break;
			case 1: stockPrice = 1.0;
				break;
			case 2: stockPrice = 8.0;
				break;
		}
	}
	else
	{
		stockPrice = 0;
	}
	
	return stockPrice;
}

//calculates frame price of item based on what frame is chosen and the size of the image
function calculateFrame(frame, size)
{
	var framePrice = 0;
	if(frame == 0){framePrice = 0;}
	else if(frame == 1 || frame == 2 || frame == 3 || frame == 4)
	{
		if(size == 0)
		{
			framePrice = 10;
		}
		else if(size == 1)
		{
			framePrice = 12;
		}
		else if(size == 2)
		{
			framePrice = 16;
		}
		else
		{
			framePrice = 20;
		}
	}
	
	return framePrice;
}

//gets subtotal and number of frames and computes for shopping total
function computeShopping()
{
	var total = document.getElementById("total");
	total.style.color = "red";

	subtotal = getRunningTotal();
	getShippingCosts(subtotal, getFrames());
	
	var std = document.getElementById("ship1");
	setshipCost(std);
	var exr = document.getElementById("ship2");
	setshipCost(exr);	
}

//gets total number of frames in the cart
function getFrames()
{
	var itemFrames = 0;
	var frames = document.getElementsByClassName("chosenFrame");
	var qtts = document.getElementsByClassName("quantities");
	for(f = 0; f < frames.length; f++)
	{
		var chosenFrame = frames[f].value;
		if(chosenFrame != 0)
		{
			itemFrames += parseInt(qtts[f].value);
		}
	}
	
	//test
	//document.getElementById("totFrames").innerHTML = itemFrames;
	//end
	return itemFrames;
}

//gets running total based on all items in the cart
function getRunningTotal()
{
	var runTotal = 0;
	var itemTotals = document.getElementsByClassName("itemTotal");
	for(i = 0; i < itemTotals.length; i++)
	{
		item = parseFloat(itemTotals[i].innerHTML.replace("$", ''));
		runTotal += item;
	}
	document.getElementById("runningTotal").innerHTML = numeral(runTotal).format('$0,0.00');
	return runTotal;
	
}

//updates the sum total of the cart
function updateTotal(shipCost)
{
	var e = document.getElementById("runningTotal").innerHTML;
	var subtotal = e.replace("$", '');
	total = parseFloat(subtotal) + parseFloat(shipCost);
	document.getElementById("total").innerHTML = numeral(total).format('$0,0.00');
}

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
	elem.innerHTML = '<strong>' + numeral(shipCost).format('$0,0.00') + '</strong>';
	updateTotal(shipCost);
}

//computes for standard and express shipping costs based on cart total and frames on cart
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
	
	var stan = document.getElementById("ship1");
	stan.setAttribute('value', standard);
	repText = document.getElementById("std");
	repText.innerHTML = 'Standard Shipping($' + standard + ')';
	
	
	var exp = document.getElementById('ship2');
	exp.setAttribute('value', express);
	expText = document.getElementById("expr");
	expText.innerHTML = 'Express Shipping($' + express + ')';
}

function saveState()
{
	var sizes = document.getElementsByClassName("sizes");
	var stocks = document.getElementsByClassName("stocks");
	var frames = document.getElementsByClassName("frames");
	var qty = document.getElementsByClassName("quantities");
	
	for(i = 0; i < sizes.length; i++)
	{
		
	}
}