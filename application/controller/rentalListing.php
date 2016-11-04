<?php
require APP . 'model/imageUploadsModel.php';

class RentalListing extends Controller
{
    private $image_model;

    function __construct()
    {
        parent::__construct();

        $this->imageModel = new ImageUploadsModel($this->db);
    }

    public function index()
    {
        if($_GET)
        {
            $rental_listing_id =  $_GET['rental_listing_id']; // print_r($_GET);
            $image_results = $this->imageModel->getAllImages($rental_listing_id);
        }

        require APP . 'view/_templates/header.php';
        require APP . "view/viewRentalListing/index.php";
        require APP . 'view/_templates/footer.php';
    }
}
