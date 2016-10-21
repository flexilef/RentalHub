<div class="container">

  <h3>Displaying images:</h3>
  <div class="slideshow-container">

    <?php foreach ($imageresults as $image) { ?>
    <div class="mySlides fade">
        <img class="myImg" width="100%" height="200px" src="<?php echo APP . "uploads/"; ?><!--./../uploads/--><?php echo $image->image_name?>">
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


  <div id="myModal" class="modal">
    <span class="close">×</span>
    <img class="modal-content" id="img01">
    <div id="caption"></div>
  </div>

<!--	<h3>Displaying all rows in model_test:</h3>-->
<!--  <p>-->
<!--  --><?php //foreach ($results as $result) { ?>
<!--      <p>--><?php //echo "id: " . $result->id; ?><!--</p>-->
<!--      <p>--><?php //echo "name: " . $result->model_name; ?><!--</p>-->
<!--  --><?php //} ?>
<!--  </p>-->
  
<!--  <form action="--><?php //echo URL . "/proto_controller/insertModel"; ?><!--" method="POST">-->
<!--    <h3>Insert a new model:</h3>-->
<!--    <input type="text" name="name">-->
<!--    <input type="submit" name="submit_insert_model" value="Submit">-->
<!--  </form>-->
<!--  -->
<!--  <form action="--><?php //echo URL . "/proto_controller/deleteModel"; ?><!--" method="GET">-->
<!--    <h3>Delete a model with name:</h3>-->
<!--    <input type="text" name="name">-->
<!--    <input type="submit" name="submit_delete_model" value="Submit">-->
<!--  </form>-->

  <form action="<?php echo URL . "/proto_controller/uploadImage"; ?>" method="post" enctype="multipart/form-data">
    <h3>Rental Space Title</h3>
    <input type="text" name="rentalTitle"/>
    <h3>Upload Pictures</h3>
    <input type="file" name="image" />
    <input type="submit" name="upload_image" value="Upload" />
  </form>
  
  <?php //echo "URL" . URL; ?>
  
</div>
