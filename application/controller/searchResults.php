<?php
require APP . 'model/rentalListingModel.php';

class SearchResults extends Controller
{

    function __construct()
    {
        parent::__construct();

        $this->rental_listing_model = new RentalListingModel($this->db);
    }

    public function index()
    {
        if(isset($_POST["submit_search"]))
        {
            if(isset($_POST["rental_search"]))
            {
                $search_string = $_POST["rental_search"];

                //$search_results = $this->rental_listing_model->searchResults($search);
                $search_results = $this->rental_listing_model->searchRentalListings($search_string);
                var_dump($search_results);

                $rental_ids = array();
                $rental_id_to_images = array();
                $rental_id_to_title = array();
                $rental_id_to_price = array();

                foreach($search_results as $result)
                {
                    $rental_ids[] = $result['id'];
                    $rental_id_to_title[$result['id']] = $result['title'];
                    $rental_id_to_price[$result['id']] = $result['price'];
                    $rental_id_to_images[$result['id']][] = $this->rental_listing_model->getImages($result['id']);
                }

                $rental_ids = array_unique($rental_ids);
            }
        }

        require APP . 'view/_templates/header.php';
        require APP . "view/viewSearchResults/index.php";
        require APP . 'view/_templates/footer.php';
    }
}
