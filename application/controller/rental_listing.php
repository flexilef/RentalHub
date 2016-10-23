<?php
 require APP . 'model/modelTest.php';
class View_Rental_Listing extends Controller
{
   private $imageModel;

  function __construct() {
    parent::__construct();

    $this->imageModel = new modelTest($this->db);
  }
	 public function index() {

    if($_GET){
        $rental_listing_id =  $_GET['rental_listing_id']; // print_r($_GET);
        $imageresults = $this->imageModel->getAllImages($rental_listing_id);
    }
        require APP . 'view/_templates/header.php';
        require APP . "view/view_rental_listing/index.php";
        require APP . 'view/_templates/footer.php';
      }
 }
