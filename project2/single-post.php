<?php

require_once('includes/travel-setup.inc.php');
include('lib/helpers/travel-utilities.inc.php');

$id = "";
$get = $_GET['id'];
if(isset($get) && $get != "" && is_numeric($get)){ $id = $get; } else { header('Location: error.php'); }

$postGate = new TravelPostTableGateway($dbAdapter);
$post = $postGate->findById($id);
$title = $post->Title;
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
           <li><a href="index.php">Home</a></li>
           <li><a href="browse.php">Browse</a></li>
           <li><a href="browse-posts.php">Posts</a></li>
           <li class="active"><?php echo $title; ?></li>
         </ol>          
    
         <div class="page-header">
            <h1><?php echo $title; ?></h1>
         </div>         
         <div class="row">
            <div class="col-md-9">
               <p><?php echo utf8_encode($post->Message); ?></p>
               <div class="well well-sm"> 
                  <h4>Images for Post</h4>        
                  <div class="row">
                     <?php
						$imgGate = new TravelImageTableGateway($dbAdapter);
						$result = $imgGate->findForPost($id);
						displayImagesThumbnails($result);
					 ?>
                  </div>
               </div>
         
            </div>
            <div class="col-md-3"> 
               <div class="panel panel-default">
                 <div class="panel-heading">Posted By</div>
                 <div class="panel-body">
                   <?php 
				   $userGate = new TravelUserTableGateway($dbAdapter);
				   $user = $userGate->findById($post->UID);
				   echo generateUserLink($user); 
				   ?>
                   <hr>
                   <p><em>Posts by this user</em></p>
                     <?php
                        $posts = $postGate->findForUser($user->UID);
						foreach($posts as $row)
						{
							$link = "single-post.php?id=" . $row->PostID;
							$label = $row->Title;
							echo generateLink($link, $label, '');
							echo '<br/>';
						}
						// display other posts by  this user
                     ?>                   
                 </div>
               </div>    

               <div class="panel panel-success">
                 <div class="panel-heading">Social</div>
                 <div class="panel-body">
                   <p><a href="add-fav.php?favpost=<?php echo $id; ?>" class="btn btn-primary btn-sm">Add to Favorites</a></p>
                   <p><a href="view-favorites.php" class="btn btn-success btn-sm">View Favorites</a></p>                  
                 </div>
               </div>    

               
            </div>   <!-- end right column -->                  
         </div>  <!-- end row -->

         
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
