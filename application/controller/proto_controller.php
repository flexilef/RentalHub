<?php
require APP . 'model/modelTest.php';
require APP . 'model/rentalListingModel.php';

class Proto_Controller extends Controller {
  
  private $imageModel;
  private $rentalListingModel;
    public $imageresults;
  
  function __construct() {
    parent::__construct();
    
    $this->imageModel = new modelTest($this->db);
    $this->rentalListingModel = new rentalListingModel($this->db);
  }

  public function index() {
      require APP . 'view/_templates/header.php';
    require APP . "view/proto_view/proto_index.php";
    require APP . 'view/_templates/footer.php';
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
    }
    
  public function submitPost() {
    if(isset($_POST["submit_post"])) {
      if(isset($_POST["rental_title"])) {
        //need to have a rental_listing before we can add image_uploads
        $this->rentalListingModel->insertRentalListing($_POST["rental_title"]);
        $rental_listing_id = $this->rentalListingModel->getLatestId();
      }

      //upload images
      if($_FILES['images']['name'])
      {
          foreach ($_FILES['images']['name'] as $name => $value) {
              $image = stripslashes($_FILES['images']['name'][$name]);
              $image = rand(1000,100000)."-".$_FILES['images']['name'][$name];
              $image_loc = $_FILES['images']['tmp_name'][$name];
              $image_size = $_FILES['images']['size'][$name];
              $image_type = $_FILES['images']['type'][$name];
              $folder=APP."../public/uploads/";

              // new file size in KB
              $new_image_size = $image_size/1024;

              // make file name in lower case
              $new_image_name = strtolower($image);

              $final_image=str_replace(' ','-',$new_image_name);

              move_uploaded_file($_FILES['image']['tmp_name'], $folder.$final_image); // Move the uploaded file to the desired folder
              $this->imageModel->uploadImage($final_image, $image_type, $new_image_size, $rental_listing_id);

          }
          $this->imageresults = $this->imageModel->getAllImages($rental_listing_id);
      }
        header('Location:' . URL . 'proto_controller/index');
    }
  }
}

?>
