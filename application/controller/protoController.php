<?php
require APP . 'model/imageUploadsModel.php';
require APP . 'model/rentalListingModel.php';

class ProtoController extends Controller
{

    private $image_model;
    private $rental_listing_model;
    public $image_results;
    public $search_results;

    function __construct()
    {
        parent::__construct();

        $this->image_model = new ImageUploadsModel($this->db);
        $this->rental_listing_model = new RentalListingModel($this->db);
    }

    public function index()
    {
        require APP . 'view/_templates/header.php';
        require APP . "view/protoView/index.php";
        require APP . 'view/_templates/footer.php';
    }


    public function submitPost()
    {
      if(isset($_POST["submit_post"]))
      {
        if(isset($_POST["rental_title"]))
        {
          //need to have a rental_listing before we can add image_uploads
          $this->rental_listing_model->insertRentalListing($_POST["rental_title"]);
          $rental_listing_id = $this->rental_listing_model->getLatestId();
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
                $folder = APP."../public/uploads/";

                // new file size in KB
                $new_image_size = $image_size/1024;

                // make file name in lower case
                $new_image_name = strtolower($image);

                $final_image=str_replace(' ','-',$new_image_name);
                move_uploaded_file($_FILES['images']['tmp_name'][$name], $folder.$final_image); // Move the uploaded file to the desired folder
                $this->image_model->uploadImage($final_image, $image_type, $new_image_size, $rental_listing_id);
            }
        }
        header('Location:' . URL . 'rentalListing/index?rental_listing_id='.$rental_listing_id);
        }
    }
}

?>
