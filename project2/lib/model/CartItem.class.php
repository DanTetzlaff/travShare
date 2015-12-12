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
<<<<<<< HEAD
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
=======
public $index;

function __construct($img, $path, $title) {
	$this->image = $img;
	$this->imageSize = '8"x10"';
	$this->imageQuantity = 1;
	$this->imageStock = "Matte";
	$this->imageFrame = "None";
	$this->path = $path;
	$this->title = $title;
	$this->total = $this->calculateTotal();
	$this->index = $this->getIndex();
}

function getTotal() {
	$this->calculateTotal();
>>>>>>> origin/master
	return $this->total;
}

function getQuantity() {
	return $this->imageQuantity;
<<<<<<< HEAD
}

function countFrames() {
	if ($this->imageFrame == 0) { return 0;}
=======
}

function getIndex() {
	 $this->makeIndex();
	 return $this->index;
}

function countFrames() {
	if ($imageFrame = "None") { return 0;}
>>>>>>> origin/master
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

<<<<<<< HEAD
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
	"<select class='form-control input-sm' name='itemSize[]'>
		<option selected value=0>$size1</option>
		<option value=1>$size2</option>
		<option value=2>$size3</option>
		<option value=3>$size4</option>
	</select>";
}

function displayStockDropdown()
{
	return 
	"<select class='form-control input-sm' name='itemStock[]'>
		<option selected value=0>Matte</option>
		<option value=1>Glossy</option>
		<option value=2>Canvas</option>
	</select>";
}
=======
function calculateTotal() {
	$runningTotal = 0;
	if ($this->imageSize == '5"x7"') { $runningTotal += 0.5;}
	else if ($this->imageSize == '8"x10"') { $runningTotal += 2.5;}
	else if ($this->imageSize == '11"x14"') { $runningTotal += 6.0;}
	else if ($this->imageSize == '12"x18"') { $runningTotal += 7.0;}
	
	if($this->imageStock == "Matte") {}
	else if ($this->imageStock == "Glossy" AND $this->imageSize == '5"x7"' OR $this->imageSize == '8"x10"' ) { $runningTotal += 0.5;}
	else if ($this->imageStock == "Glossy" AND $this->imageSize == '11"x14"' OR $this->imageSize == '12"x18"' ) { $runningTotal += 1.0;}
	else if ($this->imageStock == "Canvas" AND $this->imageSize == '5"x7"' OR $this->imageSize == '8"x10"' ) { $runningTotal += 4.0;}
	else if ($this->imageStock == "Canvas" AND $this->imageSize == '11"x14"' OR $this->imageSize == '12"x18"' ) { $runningTotal += 8.0;}
	
	if ($this->imageFrame == "None") {}
	else if ($this->imageSize == '5"x7"') { $runningTotal += 10.0;}
	else if ($this->imageSize == '8"x10"') { $runningTotal += 12.0;}
	else if ($this->imageSize == '11"x14"') { $runningTotal += 16.0;}
	else if ($this->imageSize == '12"x18"') { $runningTotal += 20.0;}
	
	$runningTotal = $runningTotal*$this->imageQuantity;
	
	$this->total = $runningTotal;
}

function makeIndex() {
	$this->index = $this->image .  $this->imageSize . $this->imageStock . $this->imageFrame;
}

function cartView() {
	$size1 = '8"x10"';
	$size2 = '5"x7"';
	$size3 = '11"x14"';
	$size4 = '12"x18"';
	
	echo "<td><img src='images/travel/square-tiny/" . $this->path . "'/></td>";
	echo "<td>$this->title</td>";
	echo "<td><select class='form-control input-sm' name='size' >
								<option selected='" . $this->imageSize . "'>$this->imageSize</option>
								<option value='$size1'>$size1</option>
								<option value='$size2'>$size2</option>
								<option value='$size3'>$size3</option>
								<option value='$size4'>$size4</option></select></td>";
	echo "<td><select class='form-control input-sm' name='stock'>
								<option selected='" . $this->imageStock . "'>$this->imageStock</option>
								<option value='Matte'>Matte</option>
								<option value='Glossy'>Glossy</option>
								<option value='Canvas'>Canvas</option></select></td>";
	echo "<td><select class='form-control input-sm' name='frame'>
								<option selected='" . $this->imageFrame . "'>$this->imageFrame</option>
								<option value='None'>None</option>
								<option value='Blonde Maple'>Blonde Maple</option>
								<option value='Expresso Walnut'>Expresso Walnut</option>
								<option value='Gold Accent'>Gold Accent</option>
								<option value='Silver Metal'>Silver Metal</option></select></td>";
	echo "<td><select class='form-control input-sm' name='qty'>
								<option value='" . $this->imageQuantity . "'>$this->imageQuantity</option>"; 
								for($i = 1; $i < 16; $i++)
								{
									echo "<option value='" . $i . "'>" . $i . "</option>";
								} 
	echo 						"</select></td>";
	echo "<td>$this->total</td>";
	echo "<td>
			<a  href = 'rev-cart.php?id=" . $this->image . "&index=" . $this->index . "'><button class='btn btn-warning'  type = 'button' name = 'remove'>Remove</button></a>
			<button class='btn btn-success'  type = 'submit' name = 'index' value ='" . $this->index . "'>Update</button>
		</td>";
>>>>>>> origin/master

function displayFrameDropdown()
{
	return 
	"<select class='form-control input-sm' name='itemFrame[]'>
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