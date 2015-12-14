<?php
/* 
Author: Michaela Day
Created: November 2015
Modified by: Carille Mendoza
Version: 2.0
Desc: Represents one item in the cart 
*/


class CartItem {

public $image;
public $imageSize;
public $imageQuantity;
public $imageStock;
public $imageFrame;
public $path;
public $title;
public $total;
public $sizePrice;
public $stockPrice;
public $framePrice;

function __construct($img, $path, $title) {
	$this->image = $img;
	$this->imageSize = 0;
	$this->imageQuantity = 1;
	$this->imageStock = 0;
	$this->imageFrame = 0;
	$this->path = $path;
	$this->title = $title;
	$this->total = $this->getTotal();
}

function getTotal() {
	$this->total = $this->calculateTotal();
	return $this->total;
}

function getQuantity() {
	return $this->imageQuantity;
}

function countFrames() {
	if ($this->imageFrame == 0) { return 0;}
	else { return $this->imageQuantity; }
}
function setImageSize($size) {
	$this->imageSize = $size;
}

function setImageQuantity($quantity) {
	$this->imageQuantity = $quantity;
}

function setImageStock($stock) {
	$this->imageStock = $stock;
}

function setImageFrame($frame) {
	$this->imageFrame = $frame;
}

//gets the amount based on the size of image chosen
function calculateSize()
{
	switch($this->imageSize)
	{
		case 0: $this->sizePrice = 0.5;
			break;
		case 1: $this->sizePrice = 2.5;
			break;
		case 2: $this->sizePrice = 6.0;
			break;
		case 3: $this->sizePrice = 7.0;
			break;
	}
	
	return $this->sizePrice;
}

//calculates stock price depending on image size 
function calculateStock()
{
	if($this->imageSize == 0 || $this->imageSize == 1)
	{
		switch($this->imageStock)
		{
			case 0: $this->stockPrice = 0;
				break;
			case 1: $this->stockPrice = 0.50;
				break;
			case 2: $this->stockPrice = 4.0;
				break;
		}
	}
	else if($this->imageSize == 2)
	{
		switch($this->imageStock)
		{
			case 0: $this->stockPrice = 0;
				break;
			case 1: $this->stockPrice = 1.0;
				break;
			case 2: $this->stockPrice = 8.0;
				break;
		}
	}
	else
	{
		$this->stockPrice = 0;
	}
	
	return $this->stockPrice;
}


//calculates frame price based on image size
function calculateFrame()
{
	if($this->imageFrame == 0){$this->framePrice = 0;}
	else if($this->imageFrame == 1 || $this->imageFrame == 2 || $this->imageFrame == 3 || $this->imageFrame == 4)
	{
		if($this->imageSize == 0)
		{
			$this->framePrice = 10;
		}
		else if($this->imageSize == 1)
		{
			$this->framePrice = 12;
		}
		else if($this->imageSize == 2)
		{
			$this->framePrice = 16;
		}
		else
		{
			$this->framePrice = 20;
		}
	}
	
	return $this->framePrice;
}

//calculates item's current total
function calculateTotal()
{
	return ($this->calculateSize() + $this->calculateStock() + $this->calculateFrame()) * $this->imageQuantity;
}

//displays image of item added to cart
function displayTinyImage()
{
	return "<img src='images/travel/square-tiny/" . $this->path . "'/>";
}

//for the image size dropdown, ensures formatting
function displaySizeDropdown()
{
	$size1 = '5"x7"';
	$size2 = '8"x10"';
	$size3 = '11"x14"';
	$size4 = '12"x18"';
	$sized = "";
	
	switch($this->imageSize)
	{
		case 0: $sized = $size1;
			break;
		case 1: $sized = $size2;
			break;
		case 2: $sized = $size3;
			break;
		case 3: $sized = $size4;
			break;
	}
	
	return 
	"<select class='form-control input-sm cartItem' id = 'sizeDrop' name='itemSize[]'>
		<option class = 'sizes' value=$this->imageSize selected = 'selected'>$sized</option>
		<option class = 'size' value=0>$size1</option>
		<option class = 'size' value=1>$size2</option>
		<option class = 'size' value=2>$size3</option>
		<option class = 'size' value=3>$size4</option>
	</select>";
}

//stock dropdown formatting
function displayStockDropdown()
{
	$stock1 = 'Matte';
	$stock2 = 'Glossy';
	$stock3 = 'Canvas';
	$stocked = "";
	
	switch($this->imageStock)
	{
		case 0: $stocked = $stock1;
			break;
		case 1: $stocked = $stock2;
			break;
		case 2: $stocked = $stock3;
			break;
	}
	return 
	"<select class='form-control input-sm cartItem' id = 'stockDrop' name='itemStock[]'>
		<option class = 'stocks' value=$this->imageStock selected = 'selected'>$stocked</option>
		<option class = 'stock' value=0>$stock1</option>
		<option class = 'stock' value=1>$stock2</option>
		<option class = 'stock' value=2>$stock3</option>
	</select>";
}

//frame dropdown formatting
function displayFrameDropdown()
{
	$frame1 = 'None';
	$frame2 = 'Blonde Maple';
	$frame3 = 'Expresso Walnut';
	$frame4 = 'Gold Accent';
	$frame5 = 'Silver Metal';
	$framed = "";
	
	switch($this->imageFrame)
	{
		case 0: $framed = $frame1;
			break;
		case 1: $framed = $frame2;
			break;
		case 2: $framed = $frame3;
			break;
		case 3: $framed = $frame4;
			break;
		case 4: $framed = $frame5;
			break;
			
	}
	
	return 
	"<select class='form-control input-sm frameDrop cartItem' name='itemFrame[]'>
		<option class = 'chosenFrame' value=$this->imageFrame  selected = 'selected'>$framed</option>
		<option class = 'frame' value=0>$frame1</option>
		<option class = 'frame' value=1>$frame2</option>
		<option class = 'frame' value=2>$frame3</option>
		<option class = 'frame' value=3>$frame4</option>
		<option class = 'frame' value=4>$frame5</option>
	</select>";
}



function displayQtyInput()
{
	return
	"<input type = 'number' id = 'itemQty' class = 'quantities' name = 'itemQty[]' min = '1' max ='100' value=$this->imageQuantity>";
}
}

?>