<?php
require APP . 'model/imageUploadsModel.php';

class RentalListing extends Controller
{
    private $image_model;

    function __construct()
    {
        parent::__construct();

        $this->image_model = new ImageUploadsModel($this->db);
        $this->rental_listing_model = new RentalListingModel($this->db);
    }

    public function index()
    {
        if($_GET)
        {
            $rental_listing_id =  $_GET['rental_listing_id']; // print_r($_GET);
            $image_results = $this->image_model->getAllImages($rental_listing_id);
            $rental_listing_description = $this->rental_listing_model->getDescription($rental_listing_id);
            $rental_listing_address = $this->rental_listing_model->getAddress($rental_listing_id);
            $rental_listing_distance = $this->rental_listing_model->getDistance($rental_listing_id);
            $rental_listing_occupants = $this->rental_listing_model->getNumberOfOccupants($rental_listing_id);
            $rental_listing_owner = $this->rental_listing_model->getOwner($rental_listing_id);
            $rental_listing_price = $this->rental_listing_model->getPrice($rental_listing_id);
            $rental_listing_type = $this->rental_listing_model->getType($rental_listing_id);
            $rental_listing_pets = $this->rental_listing_model->isPets($rental_listing_id);
        }

        require APP . 'view/_templates/header.php';
        require APP . "view/viewRentalListing/index.php";
        require APP . 'view/_templates/footer.php';
    }
}
