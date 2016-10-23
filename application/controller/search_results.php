<?php
require APP . 'model/imageUploadsModel.php';
/**
 * Created by PhpStorm.
 * User: Abhi
 * Date: 10/22/16
 * Time: 10:17 PM
 */
class Search_Results extends Controller
{

    function __construct() {
        parent::__construct();

        $this->imageModel = new ImageUploadsModel($this->db);
    }
    public function index() {

        if(isset($_POST["submit_search"])) {
            if(isset($_POST["rental_search"])) {
                $search = $_POST["rental_search"];


                $searchResults = $this->rentalListingModel->searchResults($search);

                $rentalIds = array();
                $rentalId_to_images = array();
                $rentalId_to_title = array();
                foreach($searchResults as $result) {
                    $rentalIds[] = $result['id'];
                    $rentalId_to_title[$result['id']] = $result['title'];
                    $rentalId_to_images[$result['id']][] = $result['image_name'];
                }

                $rentalIds = array_unique($rentalIds);
            }
        }
        require APP . 'view/_templates/header.php';
        require APP . "view/view_search_result/index.php";
        require APP . 'view/_templates/footer.php';
    }
}