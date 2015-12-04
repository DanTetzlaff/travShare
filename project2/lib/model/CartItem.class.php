<?php
/* Represents one item in the cart */

class CartItem {

public $image;
public $imageSize;
public $imageQuantity;
public $imageStock;
public $imageFrame;
public $path;
public $title;
public $total;
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
	return $this->total;
}

function getQuantity() {
	return $this->imageQuantity;
}

function getIndex() {
	 $this->makeIndex();
	 return $this->index;
}

function countFrames() {
	if ($imageFrame = "None") { return 0;}
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

}

}
?>