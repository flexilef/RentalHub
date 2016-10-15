<div class="container">
	<p>Displaying all rows in model_test:<p>
  <p>
  <?php foreach ($results as $result) { ?>
      <p><?php echo "id: " . $result->id; ?></p>
      <p><?php echo "name: " . $result->model_name; ?></p>
  <?php } ?>
  </p>
  
</div>
