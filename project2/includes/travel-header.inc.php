<?php
	if (session_status() == PHP_SESSION_NONE) {
    session_start();
	}
	
	function countCart()
	{
		return count($_SESSION['cart']);
	}
	
	function countFav()
	{
		return count($_SESSION['favimgs']) + count($_SESSION['favposts']);
	}
?>

<header>
   <div id="topHeaderRow">
      <div class="container">
         <div class="pull-right">
            <ul class="list-inline">
              <li><a href="#"><span class="glyphicon glyphicon-user"></span> Profile</a></li>
              <li><a href="view-favorites.php"><span class="glyphicon glyphicon-star"></span> Favorites <span class="badge"><?php echo countFav(); ?></span></a></li>
			  <li><a href="#"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
			  <li><a href="#"><span class="glyphicon glyphicon-shopping-cart"></span> Cart <span class="badge"><?php echo countCart(); ?></span></li>
            </ul>         
         </div>
      </div>
   </div>  <!-- end topHeaderRow --> 
    <div class="navbar navbar-default ">
      <div class="container">
         <nav>
           <div class="navbar-header">
             <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
             </button>
             <a class="navbar-brand" href="index.php">Share Your Travels</a>
           </div>
           <div class="navbar-collapse collapse">
             <ul class="nav navbar-nav">
               <li><a href="index.php">Home</a></li>
               <li><a href="aboutus.php">About</a></li>
               <li><a href="#contact">Contact</a></li>
               <li class="dropdown">
                 <a href="#" class="dropdown-toggle" data-toggle="dropdown">Browse <b class="caret"></b></a>
                 <ul class="dropdown-menu">
                   <li><a href="browse-posts.php">Posts</a></li>
                   <li><a href="browse-images.php">Images</a></li>
                   <li class="divider"></li>
                   <li><a href="browse-countries.php">Countries</a></li>
                   <li><a href="browse-users.php">Users</a></li>                
                 </ul>
               </li>
             </ul>
			<form class = "navbar-form navbar-right" role="search">
				<div class="form-group">
					<input type="text" class="form-control" placeholder="Search" name="search">
				</div>
				<button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>				
			</form>
		   </div><!--end container -->
        </nav>
      </div>
    </div>  <!-- end navbar -->

</header>

