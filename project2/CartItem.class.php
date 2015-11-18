<?php
/* Represents one item in the cart */

class CartItem {

public $image;
public $imageSize;
public $imageQuantity;
public $imageStock;
public $imageFrame;
public $total;

function __construct($img, $size, $quantity, $stock, $frame) {
	$image = $img;
	$imageSize = $size;
	$imageQuantity = $quantity;
	$imageStock = $stock;
	$imageFrame = $frame;
	//$total = calculateTotal();
}

function getTotal() {
	return total();
}

function getQuantity() {
	return $imageQuantity;
}

function countFrames() {
	if ($imageFrame = "None") { return 0;}
	else { return $imageQuantity; }
}

function setImageSize($size) {
	$imageSize = $size;
}

function setImageQuantity($quantity) {
	$imageQuantity = $quantity;
}

function setImageStock($stock) {
	$imageStock = $stock;
}

function setImageFrame($frame) {
	$imageFrame = $frame;
}

function calculateTotal() {
	$runningTotal = 0;
	if ($imageSize = '5"x7"') { $runningTotal += 0.5;}
	else if ($imageSize = '8"x10"') { $runningTotal += 2.5;}
	else if ($imageSize = '11"x14"') { $runningTotal += 6.0;}
	else if ($imageSize = '12"x18"') { $runningTotal += 7.0;}
	
	if($imageStock = "Matte") {}
	else if ($imageStock = "Glossy" AND $imageSize = '5"x7"' OR $imageSize = '8"x10"' ) { $runningTotal += 0.5;}
	else if ($imageStock = "Glossy" AND $imageSize = '11"x14"' OR $imageSize = '12"x18"' ) { $runningTotal += 1.0;}
	else if ($imageStock = "Canvas" AND $imageSize = '5"x7"' OR $imageSize = '8"x10"' ) { $runningTotal += 4.0;}
	else if ($imageStock = "Canvas" AND $imageSize = '11"x14"' OR $imageSize = '12"x18"' ) { $runningTotal += 8.0;}
	
	if ($imageFrame = "None") {}
	else if ($imageSize = '5"x7"') { $runningTotal += 10.0;}
	else if ($imageSize = '8"x10"') { $runningTotal += 12.0;}
	else if ($imageSize = '11"x14"') { $runningTotal += 16.0;}
	else if ($imageSize = '12"x18"') { $runningTotal += 20.0;}
	
	$runningTotal = $runningTotal*$imageQuantity;
	
	$total = $runningTotal;
}

function cartView() {
	echo "<td>PIC HERE</td>";
	echo "<td>TITLE HERE</td>";
	echo "<td>$imageSize</td>";
	echo "<td>$imageStock</td>";
	echo "<td>$imageFrame</td>";
	echo "<td>$imageQuantity</td>";
	echo "<td>$total</td>";
	echo "<td>
			<a  href = 'index.php'><button class='btn btn-warning'  type = 'button' name = 'remove'>Remove</button></a>
			<a href = 'process-cart.php'><button class='btn btn-info'  type = 'button' name = 'update'>Update</button></a>
		</td>";

}

}
?>