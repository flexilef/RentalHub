<?php

require APP . 'model/rentalListingModel.php';

/**
 * @Author Osama
 */
class DeleteListing extends Controller {

    function __construct() {
        parent::__construct();

        $this->rental_listing_model = new RentalListingModel($this->db);
    }

    public function index() {

        
        if ($_REQUEST['delete']) {
            $status = false;
            $pid = $_REQUEST['delete'];
           
            $status = $this->rental_listing_model->deleteRentalListing($pid);

            if ($status) {
                echo "Product Deleted Successfully ...";
            }


            // load views
//            require APP . 'view/profilePage/index.php';
//            require APP . 'view/_templates/header.php';
//            require APP . 'view/_templates/footer.php';
        }
    }

}
