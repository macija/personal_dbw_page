<?php
include("html/head.html");
include("html/nav_bar.html");
?>
<div class="container px-4 px-lg-5" id="pictures">
<div class="row gx-4 gx-lg-4 align-items-centermy-5" id="head_pictures">
<div class="card text-white bg-secondary my-5 py-4 text-center">
<div class="card-body">
<h1 class="h1">
	My pictures
</h1>
</div>
</div>
<div class= "row gx-4 gx-lg-5 align-items-center my-5">
<h4 class="font-weight-light">Here I would like to share with you what it is one of my passions: photograpy.
</h4>
</div>
</div>
<div id="gg-screen"></div>
<div class="gg-box">
<?php 

  // Image extensions
  $image_extensions = array("png","jpg","jpeg","gif");
  $img_array = array();

  // Target directory
  $dir = 'assets/gallery/';
  if (is_dir($dir)){
 
   if ($dh = opendir($dir)){
    $photo_count = 1;
    $photo_count_arr = [];

    // Read files
    while (($file = readdir($dh)) !== false){

     if($file != '' && $file != '.' && $file != '..'){
 
      // Thumbnail image path
      $thumbnail_path = "assets/gallery/thumbnails/".$file;

      // Image path
      $image_path = "assets/gallery/".$file;
 
      $thumbnail_ext = pathinfo($thumbnail_path, PATHINFO_EXTENSION);
      $image_ext = pathinfo($image_path, PATHINFO_EXTENSION);

      // Check its not folder and it is image file
      if(!is_dir($image_path) && 
         in_array($thumbnail_ext,$image_extensions) && 
         in_array($image_ext,$image_extensions)){
          $img_array[] = $image_path;
   ?>

       <!-- Image -->
       <div class="gg-element">
    <img src="<?php echo $image_path; ?>">
  </div>
       <?php
       $photo_count_arr[] = $photo_count;
       $photo_count ++;

      }
     }
 
    }
    closedir($dh);
   }
  }
 ?>  
 

</div>

<?php
include("html/footer.html");
?>

<script type="text/javascript" src="js/grid-gallery.js"></script>

</body>
