<div class="container">
  <form action="<?php echo URL . "/proto_controller/submitPost"; ?>" method="post" enctype="multipart/form-data">
      <h3>Rental Space Title</h3>
      <input type="text" name="rental_title"/>
      <h3>Upload Pictures</h3>
      <div>
          <input multiple="true" type="file" name="images[]" />
          <br>
          <input type="submit" name="submit_post" value="Post" />
      </div>
    </form>
</div>
