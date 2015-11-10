<?php
session_start();
require_once('includes/travel-setup.inc.php');
include('lib/helpers/travel-utilities.inc.php'); 

$userGateway = new TravelUserTableGateway($dbAdapter); 
$users = $userGateway->findAllSorted(true);

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <title>Travel Template</title>
   <?php include 'includes/travel-head.inc.php'; ?>
</head>
<body>

<?php include 'includes/travel-header.inc.php'; ?>
   
<div class="container">  <!-- start main content container -->
   <div class="row">  <!-- start main content row -->
      <div class="col-md-3">  <!-- start left navigation rail column -->
         <?php include 'includes/travel-left-rail.inc.php'; ?>
      </div>  <!-- end left navigation rail --> 
      
      <div class="col-md-9">  <!-- start main content column -->
         <ol class="breadcrumb">
           <li><a href="#">Home</a></li><!--generateLink('index.php', '', 'Home'); -->
           <li><a href="#">Browse</a></li> <!--generateLink('browse.php', '', 'Browse'); -->
           <li class="active">Users</li>
         </ol>          
      
         <div class="jumbotron" id="postJumbo">
           <h1>Users</h1>
           <p>Learn about other users ... or create your own user profile.</p>
           <p><a class="btn btn-warning btn-lg">Learn more &raquo;</a></p>
         </div>        
      
         <!-- start post summaries -->
         <div class="listgroup">
         <?php
				foreach($users as $user)
				{
					 echo '<li class="list-group-item"><a href="single-user.php?uid=' . $user->UID . '">' . utf8_encode($user->FirstName . ' ' . $user->LastName) . '</a></li>';
				}
         ?>
         </div>
		<br/><br/>
      </div>  <!-- end main content column -->
   </div>  <!-- end main content row -->
</div>   <!-- end main content container -->
   
<?php include 'includes/travel-footer.inc.php'; ?>   

   
   
 <!-- Bootstrap core JavaScript
 ================================================== -->
 <!-- Placed at the end of the document so the pages load faster -->
 <script src="bootstrap3_travelTheme/assets/js/jquery.js"></script>
 <script src="bootstrap3_travelTheme/dist/js/bootstrap.min.js"></script>
 <script src="bootstrap3_travelTheme/assets/js/holder.js"></script>
</body>
</html>