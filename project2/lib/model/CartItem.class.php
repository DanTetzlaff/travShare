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

function calculateTotal()
{
	return ($this->calculateSize() + $this->calculateStock() + $this->calculateFrame()) * $this->imageQuantity;
}

function displayTinyImage()
{
	return "<img src='images/travel/square-tiny/" . $this->path . "'/>";
}

function displaySizeDropdown()
{
	$size1 = '5"x7"';
	$size2 = '8"x10"';
	$size3 = '11"x14"';
	$size4 = '12"x18"';
	
	return 
	"<select class='form-control input-sm' id = 'sizeDrop' name='itemSize[]'>
		<option selected=$this->imageSize>$this->imageSize</option>
		<option value=0>$size1</option>
		<option value=1>$size2</option>
		<option value=2>$size3</option>
		<option value=3>$size4</option>
	</select>";
}

function displayStockDropdown()
{
	return 
	"<select class='form-control input-sm' id = 'stockDrop' name='itemStock[]'>
		<option selected=$this->imageStock>$this->imageStock</option>
		<option value=0>Matte</option>
		<option value=1>Glossy</option>
		<option value=2>Canvas</option>
	</select>";
}

function displayFrameDropdown()
{
	return 
	"<select class='form-control input-sm' id = 'frameDrop' name='itemFrame[]'>
		<option selected=$this->imageFrame>$this->imageFrame</option>
		<option value=0>None</option>
		<option value=1>Blonde Maple</option>
		<option value=2>Expresso Walnut</option>
		<option value=3>Gold Accent</option>
		<option value=4>Silver Metal</option>
	</select>";
}



function displayQtyInput()
{
	return
	"<input type = 'number' name = 'itemQty[]' min = '1' max ='100' value = '$this->imageQuantity'>";
}
}

?>