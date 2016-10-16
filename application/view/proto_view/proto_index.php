<div class="container">
	<h3>Displaying all rows in model_test:</h3>
  <p>
  <?php foreach ($results as $result) { ?>
      <p><?php echo "id: " . $result->id; ?></p>
      <p><?php echo "name: " . $result->model_name; ?></p>
  <?php } ?>
  </p>
  
  <form action="<?php echo URL . "/proto_controller/insertModel"; ?>" method="POST">
    <h3>Insert a new model:</h3>
    <input type="text" name="name">
    <input type="submit" name="submit_insert_model" value="Submit">
  </form>
  
  <?php echo URL; ?>
  
</div>
