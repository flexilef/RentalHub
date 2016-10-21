<?php
require APP . 'model/modelTest.php';

class Proto_Controller extends Controller {
  
  function __construct() {
    parent::__construct();
    
    $this->model = new modelTest($this->db);
  }

  public function index() {
    $results = $this->model->getAllModels();
      $imageresults = $this->model->getAllImages();

    require APP . 'view/_templates/header.php';
    require APP . "view/proto_view/proto_index.php";
    require APP . 'view/_templates/footer.php';
  }
  
  public function insertModel() {
    if(isset($_POST["submit_insert_model"]) 
      && isset($_POST["name"])) {
      $name = $_POST["name"];
      $this->model->insertModel($name);
    }
    
    header('Location:' . URL . 'proto_controller/index');
  }
  
  public function deleteModel() {
    if(isset($_GET["submit_delete_model"]) 
      && isset($_GET["name"])) {
      $name = $_GET["name"];
      $this->model->deleteModel($name);
    }
    
    header("Location:" . URL . "proto_controller/index");
  }

    public function uploadImage() {
        if($_FILES['image']['name'])
        {
            $image = rand(1000,100000)."-".$_FILES['image']['name'];
            $image_loc = $_FILES['image']['tmp_name'];
            $image_size = $_FILES['image']['size'];
            $image_type = $_FILES['image']['type'];
            $folder=APP."../public/uploads/";
            // new file size in KB
            $new_image_size = $image_size/1024;
            // new file size in KB

            // make file name in lower case
            $new_image_name = strtolower($image);
            // make file name in lower case

            $final_image=str_replace(' ','-',$new_image_name);

            move_uploaded_file($_FILES['image']['tmp_name'], $folder.$final_image); // Move the uploaded file to the desired folder
            $this->model->uploadImage($final_image, $image_type, $new_image_size);
        }

        header('Location:' . URL . 'proto_controller/index');
    }
}

?>

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
