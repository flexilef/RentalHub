<div class="container">
  <form action="<?php echo URL . "/protoController/submitPost"; ?>" method="post" enctype="multipart/form-data">
      <h3>Rental Space Title</h3>
      <input type="text" name="rental_title" placeholder="Great One Bedroom Apartment"/>

      <h3>Rental Space Description</h3>
      <input type="text" name="rental_description" placeholder="A wonderful apartment with a view of Lake Merced, and walking distance from SFSU."/>

      <h3>Rental Address</h3>
      <input type="text" name="rental_address" placeholder="123 Wall Street"/>

      <h3>Rental Monthly Price in US Dollars</h3>
      <input type="number" name="rental_price" placeholder="1234"/>

      <h3>Type of Rental Space</h3>
      <input type="radio" name="rental_type" value="Bedroom"/><label for="Bedroom"> Bedroom </label> <br>
      <input type="radio" name="rental_type" value="Apartment"/><label for="Apartment"> Apartment</label> <br>
      <input type="radio" name="rental_type" value="House"/><label for="House"> House </label> <br>

      <h3>Number of Occupants Allowed</h3>
      <input type="number" name="rental_occupants" placeholder="2"/>

      <h3>Animals Allowed?</h3>
      <input type="checkbox" name="rental_animals"/>

      <h3>Upload Pictures of Your Place</h3>
      <div>
          <input multiple="true" type="file" name="images[]" />
          <br>
          <input type="submit" name="submit_post" value="Post" />
      </div>
    </form>
</div>
