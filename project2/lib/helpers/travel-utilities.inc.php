<?php

//print array of images as thumbnails with links to the single image page for each unique image
function displayImagesThumbnails($images) {

   foreach ($images as $img) { 
            
      echo '<div class="col-md-3">';
      echo '<a href="single-image.php?id=' . $img->ImageID . '" class="thumbnail bottomspacing" >';
      echo '<img class="thumbImg" src="images/travel/square/' . $img->Path . '" alt="' . $img->Title . '" title="' . $img->Title . '">';
      echo '</a>';
      echo '</div>';

   }
}

function searchImages($dbAdapter, $phrase) {
	$imagesGate = new TravelImageTableGateway($dbAdapter);
	$images = null;
	$images = $imagesGate->findForSearch($phrase);
	displayImagesThumbnails($images);
}

function retrieveImages($imagesGate, $city, $country) {
   $images = null;
   if ($_SERVER['REQUEST_METHOD'] == 'GET' && ( isset($city) || isset($country))) {
      $parameters = Array();
      $where = "";
      
      if (isset($country) && $country != 'ZZZ') {
         $where = "CountryCodeISO=?";
         $parameters[] = $country;
      }
      if (isset($city) && $city != 0) {
         if (! empty($where) ) {
            $where .= " AND ";
         }
         $where .= " CityCode=?";
         $parameters[] = $city;   
      }  
      if (! empty($where)) {
         $images = $imagesGate->findBy($where, $parameters, 'Title');
      }
   }
   if (is_null($images)) {
      $images = $imagesGate->findAllSorted(true);
   }  
   return $images;
}

function generateUserLink($user) {
   $userEncoded =  utf8_encode($user->FirstName . ' ' . $user->LastName) ;
   return generateLink("single-user.php?uid=" . $user->UID,$userEncoded,null);
}

function outputPostRow($post, $dbAdapter)  {
   
   // super inefficient (way too many database accesses) but clear to understand
   $imagesGate = new TravelImageTableGateway($dbAdapter);
   $imageForPost = $imagesGate->findById( $post->MainPostImage );
   
   
   $postLink = 'single-post.php?id='. $post->PostID;   
   $image = '<img src="images/travel/square/' . $imageForPost->Path . '" alt="' . $post->Title . '" class="img-thumbnail"/>';   


   echo '<div class="row">';
   echo '<div class="col-md-2">';   
   echo generateLink($postLink, $image, null);
   echo '</div>';
   echo '<div class="col-md-10">';
   echo '<h2>' . $post->Title . '</h2>';
   echo '<div class="details">'; 
	
	$userGate = new TravelUserTableGateway($dbAdapter);
	$user = $userGate->findById($post->UID);
   echo 'Posted by ' . generateUserLink($user);
   echo '<span class="pull-right">' . date("Y/m/d", strtotime($post->PostTime)) . '</span>';
   echo '</div>';
   echo '<p class="excerpt">';
   
   $excerpt = substr($post->Message, 0, 200);
   
   echo utf8_encode($excerpt . ' ...');
   echo '</p>';
   echo '<p>' . generateLink($postLink, 'Read more', 'btn btn-primary btn-sm') . '</p>';
   echo '</div>';
   echo '</div>';
}

function generateLink($url, $label, $class) {
   $link = '<a href="' . $url . '" class="' . $class . '">';
   $link .= $label;
   $link .= '</a>';
   return $link;
}


function ouputPagination($startNum, $currentNum) {
   echo '<ul class="pagination">';
   $disabled = '';
   if ($startNum <= 10) $disabled = ' class="disabled"';
   echo '<li' . $disabled . '>' . generateLink("#","&laquo;",null) . '</li>';
   
   $number = $startNum;
   for ($i=0; $i < 10; $i++) {
      $active = '';
      if ($number == $currentNum) $active = ' class="active"';
      echo '<li' . $active . '>';
      echo generateLink('#', $number,null);
      $number++;
   }

           
   echo '<li><a href="#">&raquo;</a></li>';
   echo '</ul>';
     
}

//using user object pull first and last name, combine and encode together, return single string
function buildUName($user) {
	$first = $user->FirstName;
	$last = $user->LastName;
	
	return utf8_encode($first . ' ' . $last);
}

//creates list of items in favorite posts list 
function favPosts ($fPost, $dbAdapter) {	
	$postGate = new TravelPostTableGateway($dbAdapter);
	
	foreach ($fPost as $id)
	{
		$post = $postGate->findById($id);
		
		$imagesGate = new TravelImageTableGateway($dbAdapter);
		$imageForPost = $imagesGate->findById( $post->MainPostImage );
		
		$postLink = 'single-post.php?id='. $post->PostID;   
		$image = '<img src="images/travel/square-small/' . $imageForPost->Path . '" alt="' . $post->Title . '" class="img-thumbnail"/>';
		
		echo "<li class='list-group-item'>" . $image . " " . generateLink($postLink, $post->Title, null);
		echo "<div class='pull-right'><button type='button' class='btn btn-warning btn-xs'>" . generateLink('rm-fav.php?postId='.$post->PostID, "Remove", null) . "</button></div></li>";
	}
}

//creates list of items in favorite images list 
function favImg ($fImg, $dbAdapter) {
	$imageGate = new TravelImageTableGateway($dbAdapter);
	
	foreach ($fImg as $id)
	{
		$img = $imageGate->findById($id);
		
		$imageLink = 'single-image.php?id=' . $img->ImageID;
		$image = '<img src="images/travel/square-small/' . $img->Path . '" alt="' . $img->Title . '" class="img-thumbnail"/>';
		
		echo "<li class='list-group-item'>" . $image . " " . generateLink($imageLink, $img->Title, null);
		echo "<div class='pull-right'><button type='button' class='btn btn-warning btn-xs'>" . generateLink('rm-fav.php?imgId='.$img->ImageID, "Remove", null) . "</button></div></li>";
	}
}

//creates subtotal for each item in the cart
function processCart($cart)
{
	foreach($cart as $key => $cartItem)
	{	
		echo "<tr class = 'itemRow'>"; 
		echo "<td class = 'cartItem'><a class = 'removeItem' href='rev-cart.php?no=$key'><span class='glyphicon glyphicon-remove-circle'></span> </a></td>";
		echo "<td class = 'cartItem'>". $cartItem->displayTinyImage() . "</td>";
		echo "<td class = 'cartItem'>". $cartItem->title . "</td>";
		echo "<td class = 'cartItem'>" . $cartItem->displaySizeDropdown() . "</td>";
		echo "<td class = 'cartItem'>" . $cartItem->displayStockDropdown() . "</td>";
		echo "<td class = 'cartItem'>" . $cartItem->displayFrameDropdown() . "</td>";
		echo "<td class = 'cartItem'>" . $cartItem->displayQtyInput() . "</td>";
		echo "<td class = 'cartItem'>$ " . $cartItem->getTotal() . "</td>";	
		echo "<td><button class='btn btn-success'  type='submit' name='submit' value='$key'>Compute</button></td>";		
		echo "</tr>";
	}
	
	echo "<tr><td></td><td></td><td></td><td></td><td></td><td></td><td><strong>Total before shipping:</strong></td>";
	$subtotal = computeSubtotal($cart);
	echo "<td id = 'runningTotal'>$ " . $subtotal . "</td></tr>";
	
	//for testing
	$frames = getFrameCount($cart);
	echo "<tr><td id = 'frames'>" . $frames . "<td></tr>";
	shippingOptions($subtotal, $frames);
	
}

//computes for cart's subtotal before shipping
function computeSubtotal($cart)
{
	$subtotal = 0;
	
	foreach($cart as $item)
	{
		$subtotal += $item->getTotal();
	}
	
	return $subtotal;
}

function shippingOptions($cartTotal, $frameCount) {
	$standard = 0;
	$express = 0;
	/**$finalTotal = $cartTotal;
	if ($cartTotal > 300) { } //everything is free
	else if ($frameCount > 10)
	{
		$standard = 30;
		$express = 45;
	}
	else if ($frameCount < 10 && $frameCount > 0)
	{
		$standard = 15;
		$express = 25;
	}
	else if ($frameCount == 0)
	{
		$standard = 5;
		$express = 15;
	}
	
	if ($cartTotal > 100) { $standard = 0;}
	$finalTotal += $standard;
	**/
	echo "<tr><td></td><td></td><td></td><td></td><td> Shipping options: </td>";
	echo"<div class = 'form-group form-group-sm'>
			<div class = 'col-sm-offset-3 col-sm-9'>
				<label class='radio-inline'>
					<td><input type='radio' name='ship' type='submit' id='ship1' value='$standard'/> Standard Shipping";
	echo "($$standard) </label></td>";
	echo "<td><label class='radio-inline'>
					<input type='radio' name='ship' type='submit' id='ship2' value='$express'/> Express Shipping ";
	echo "($$express)</label></td>";
	echo "</div>
			</div></td><td id = 'shipJs'>$0</td></tr>";
	echo "<tr><td></td><td></td><td></td><td></td><td></td><td></td><td>Total:</td><td id ='total'>$$cartTotal</td></tr>";
}


//gets total number of frames in cart
function getFrameCount($cart)
{
	$totalFrames = 0;
	
	foreach($cart as $item)
	{
		$totalFrames += $item->countFrames();
	}
	
	return $totalFrames;
}

//displays empty cart
function emptyCart() {
	echo "<tr><td>You have no items in your cart</td><td> </td><td> </td><td> </td><td> </td><td> </td><td> </td><td> </td></tr>";
	echo "<tr>
			<td>Pre-shipping total:</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td>$0.00</td>
			<td></td>
		</tr>";
	shippingOptions(0, 0);
	echo "</table>";
}


/**
function getShippingCosts($cart, $subtotal)
{
	$standard = 0;
	$express = 0;
	$totalFrames = getFrameCount($cart);
	
	if($subtotal <= 300)
	{
		if($totalFrames == 0)
		{
			$standard = 5;
			$express = 15;
		}
		else if($totalFrames < 10)
		{
			$standard = 15;
			$express = 25;
		}
		else
		{
			$standard = 30;
			$express = 45;
		}
		
		if($subtotal >= 100)
		{
			$standard = 0;
		}
	}
	
	echo "</tr>";
	echo "<tr><td></td><td></td><td></td><td></td><td></td><td></td><td>";
	echo "<label class='radio-inline'>
				<input type='radio' name='shipping' id='ship1' value='standard' checked> Standard Shipping ($$standard)</input></label>
				<label class='radio-inline'>
				<input type='radio' name='shipping' id='ship2' value='express'> Express Shipping($$express)</input>
		</td></tr>";
}

function processCart($cartItems) {
	$cartTotal = 0.00;
	$frameCount = 0;
	$itemCount = 0;
	
	foreach ($cartItems as $item) {
		$cartTotal += $item->getTotal();
		$frameCount += $item->countFrames();
		$itemCount =+ $item->getQuantity();
		
		echo "<tr>";
		$item->cartView();
		echo "</tr>";
	}
	echo "<tr>
			<td>Pre-shipping total:</td>
			<td></td>
			<td></td>
			<td></td>
			<td>$frameCount</td>
			<td>$itemCount</td>
			<td>$ $cartTotal</td>
			<td></td>
		</tr>";
	shippingOptions($cartTotal, $frameCount);
	echo "</table>"; 
}
**/


?>
