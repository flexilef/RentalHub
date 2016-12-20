<?php

require APP . 'model/imageUploadsModel.php';
require APP . 'model/rentalListingModel.php';

class ProtoController extends Controller {

    private $image_model;
    private $rental_listing_model;

    function __construct() {
        parent::__construct();

        $this->image_model = new ImageUploadsModel($this->db);
        $this->rental_listing_model = new RentalListingModel($this->db);
    }

    public function index() {
        if (isset($_GET['error'])) {
            echo '<div class="alert alert-danger" role="alert"><strong>Error!</strong>Upload Image size should be less than 2 MB.</div>';
        }
        require APP . 'view/_templates/header.php';
        require APP . "view/protoView/index.php";
        require APP . 'view/_templates/footer.php';
    }

    public function submitPost() {
        if (isset($_POST["submit_post"])) {
            $allowAnimals = 0;
            if (isset($_POST["rental_animals"]))
                $allowAnimals = 1;

            $this->rental_listing_model->
                    insertRentalListing($_POST["rental_title"], $_POST["rental_description"], $_POST["rental_address"],$_POST["rental_zipcode"], $_POST["rental_price"], $this->rental_listing_model->getRentalType($_POST["rental_type"]), $_POST["rental_occupants"], $allowAnimals);

            $rental_listing_id = $this->rental_listing_model->getLatestId();


            //upload images
            if ($_FILES['images']['name']) {
                foreach ($_FILES['images']['name'] as $name => $value) {
                    $image = stripslashes($_FILES['images']['name'][$name]);
                    $image = rand(1000, 100000) . "-" . $_FILES['images']['name'][$name];
                    $image_loc = $_FILES['images']['tmp_name'][$name];
                    $image_type = $_FILES['images']['type'][$name];
                    $folder = APP . "../public/uploads/";
                    $image_size = filesize($image_loc);

                    // new file size in KB
                    $new_image_size = $image_size / 1024;

                    if (!$image_size || $new_image_size > 1500) {
                        header('Location:' . URL . 'protoController/index?error=largeImage');
                        return;
                    }

                    // make file name in lower case
                    $new_image_name = strtolower($image);

                    $final_image = str_replace(' ', '-', $new_image_name);

                    if (move_uploaded_file($_FILES['images']['tmp_name'][$name], $folder . $final_image)) {
                        // Move the uploaded file to the desired folder
                        $this->image_model->uploadImage($final_image, $image_type, $new_image_size, $rental_listing_id);
                    }
                }
            } else {
                //have a default image for postings that don't have images. Else, make it strict to post with pics
                //Right now there is a bug: search results don't show postings without images (join/on)
            }

            header('Location:' . URL . 'rentalListing/index?rental_listing_id=' . $rental_listing_id);
        }
    }



}

?>
