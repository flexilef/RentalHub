<?php
  $image_upload_count = 1;
?>
<div class="container">

  <form action="<?php echo URL . "/proto_controller/submitPost"; ?>" method="post" enctype="multipart/form-data">
    <h3>Rental Space Title</h3>
    <input type="text" name="rental_title"/>
    <h3>Upload Pictures</h3>
    <input multiple="true" type="file" name="images[]" />
    <br>
    <input type="submit" name="submit_post" value="Submit" />
  </form>

  <div id="myModal" class="modal">
    <span class="close">×</span>
    <img class="modal-content" id="img01">
    <div id="caption"></div>
  </div>
  
  <?php //echo "URL" . URL; ?>
  
</div>
