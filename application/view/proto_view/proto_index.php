<div class="container">

  <h3>Displaying images:</h3>
  <p>
    <?php foreach ($imageresults as $image) { ?>
        <img src="/home/f16g16/public_html/final_project/application/uploads/"<?php $image->image_name?>">
  <?php } ?>
  </p>


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
