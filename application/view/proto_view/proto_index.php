<div class="container">

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

<script>
  // When the user clicks on <span> (x), close the modal
  span.onclick = function() {
    modal.style.display = "none";
  };

  // Get the modal
  var modal = document.getElementById('myModal');

  // Get the image and insert it inside the modal - use its "alt" text as a caption
  var imgs = document.getElementsByClassName('myImg');
  var modalImg = document.getElementById("img01");
  var captionText = document.getElementById("caption");
  var myFunction = function() {
    modal.style.display = "block";
    modalImg.src = this.src;
    captionText.innerHTML = this.alt;
  };

  for (var i = 0; i < imgs.length; i++) {
    imgs[i].addEventListener('click', myFunction, false);
  }

  // Get the <span> element that closes the modal
  var span = document.getElementsByClassName("close")[0];


  var slideIndex = 1;
  showSlides(slideIndex);

  function plusSlides(n) {
    showSlides(slideIndex += n);
  }

  function currentSlide(n) {
    showSlides(slideIndex = n);
  }

  function showSlides(n) {
    var i;
    var slides = document.getElementsByClassName("mySlides");
    var dots = document.getElementsByClassName("dot");
    if (n > slides.length) {slideIndex = 1}
    if (n < 1) {slideIndex = slides.length}
    for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
    }
    for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex-1].style.display = "block";
    dots[slideIndex-1].className += " active";
  }
</script>
