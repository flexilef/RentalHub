<?php

require APP . 'model/sinmodel.php';
require APP . 'model/rentalListingModel.php';

    /**
     * @author Lloyd saad
     */
     
class Profile extends Controller {

    private $posted_rental_properties;

    function __construct() {
        parent::__construct();

        $this->signin_model = new Sinmodel($this->db);
        $this->rental_listing_model = new RentalListingModel($this->db);

        $this->posted_rental_properties = array();
    }

    public function index() {

        require APP . 'view/_templates/header.php';
        /**
         * Update user Profile information
         */
        if (isset($_POST['update'])) {
            $fname = $_POST['firstName'];
            $lastName = $_POST['lastName'];
            $phone = $_POST['phone'];
            $mobile = $_POST['mobile'];
            $email = $_POST['email'];
            $location = $_POST['address'];
            $password = $_POST['password'];
            $verifyPassword = $_POST['password2'];

            //Password and RePassword Must Match to update the profile
            if (strcmp($password, $verifyPassword) == 0) {
                
                $status = $this->signin_model->update($fname, $lastName, $phone, $mobile, $email, $location, $password);
                if ($status == 1) {
                    echo '<div class="alert alert-success" role="alert"><strong>Success!</strong> Successfully Updated the records.</div>';
                } else {
                    echo '<div class="alert alert-danger" role="alert"><strong>Unsuccessful!</strong> Profile is not updated.</div>';
                }
            } else {
                echo '<div class="alert alert-danger" role="alert"><strong>Error!</strong> Passwords does not match each other.</div>';
            }
        }
        $this->posted_rental_properties = $this->getPropertyListing();

        // load views
        require APP . 'view/profilePage/index.php';

        require APP . 'view/_templates/footer.php';
    }

    public function delete() {
        if ($_REQUEST['delete']) {
            $status = false;
            $pid = $_REQUEST['delete'];

            $status = $this->rental_listing_model->deleteRentalListing($pid);

            if ($status) {
                echo "Product Deleted Successfully ...";
            }
         
        }
    }

    /**
     * Get the posted property listing of user @Session[ID]
     */
    public function getPropertyListing() {
        return $this->rental_listing_model->getAllPostedProperty($_SESSION['id']);
    }

}
