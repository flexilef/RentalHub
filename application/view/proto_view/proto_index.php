<?php
  $image_upload_count = 1;
?>
<div class="container">

  <form action="<?php echo URL . "proto_controller/submitSearch"; ?>" method="post">
    <h3>Search For a Rental Space</h3>
    <input type="text" name="rental_search"/>
    <input type="submit" name="submit_search" value="Search"/>
  </form>
  
  <h4>Displaying Search Results</h4>
  <p><?php 
      if(isset($searchResults)) { 
        foreach($searchResults as $result) {
          $title = $result['title'];
          $image_name = $result['image_name'];
          
          echo "<h5>Title:" . $result['title'] . "</h5>";
          echo "<img class=\"myImg\" width=\"100%\" height=\"200px\" src=\"./../uploads/$image_name\">";
        } 
      }
      ?>
  </p>

  <?php if (isset($imageresults)) { ?>
    <h3>Displaying images:</h3>
    <div class="slideshow-container">

      <?php foreach ($imageresults as $image) { ?>
        <div class="mySlides fade">
          <img class="myImg" width="100%" height="200px" src="./../uploads/<?php echo $image->image_name?>">
        </div>
      <?php } ?>

      <a class="prev" onclick="plusSlides(-1)">❮</a>
      <a class="next" onclick="plusSlides(1)">❯</a>

    </div>
    <br>
    <?php $count = 1?>
  <div style="text-align:center">
  <?php foreach ($imageresults as $image) { ?>
      <span class="dot" onclick="currentSlide(<?php echo $count?>)"></span>
    <?php $count += 1?>
  <?php } ?>
  </div>
  <?php }else { ?>
 <form action="<?php echo URL . "/proto_controller/submitPost"; ?>" method="post" enctype="multipart/form-data">
    <h3>Rental Space Title</h3>
    <input type="text" name="rental_title"/>
    <h3>Upload Pictures</h3>
    <input multiple="true" type="file" name="images[]" />
    <br>
    <input type="submit" name="submit_post" value="Submit" />
  </form>
  <?php //echo "URL" . URL; ?>
  
</div>
