<div class="container">

  <h3>Displaying images:</h3>
  <p>
    <?php foreach ($imageresults as $image) { ?>
        <a href=""><img id="myImg" width="300px" height="200px" src="./../uploads/<?php echo $image->image_name?>"></a>
  <?php } ?>
  </p>
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
    <h3>Upload Pictures</h3>
    <input type="file" name="image" />
    <input type="submit" name="upload_image" value="Upload" />
  </form>
  
  <?php //echo "URL" . URL; ?>
  
</div>
