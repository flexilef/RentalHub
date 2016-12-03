<?php

require APP . 'model/rentalListingModel.php';

class SearchResults extends Controller {

    private $search_results;
    private $search_string;
    private $rental_ids;
    private $rental_id_to_title;
    private $rental_id_to_price;
    private $rental_id_to_date_posted;
    private $rental_id_to_images;
    private $lowest_price;
    private $highest_price;
    private $oldest_date;
    private $newest_date;
    private $alphabetical_title;
    private $reverse_alphabetical_title;
 

    function __construct() {
        parent::__construct();
        $this->rental_ids = array();
        $this->rental_id_to_title = array();
        $this->rental_id_to_price = array();
        $this->rental_id_to_date_posted = array();
        $this->rental_id_to_images = array();
        $this->rental_listing_model = new RentalListingModel($this->db);
    }
    
    /**
     * Filtered Checks : Get the Query String ,Convert into Key ,Values and
     * Pass it to the Model Class
     */
    private function getQueryString(){
        
        $url = $_SERVER["REQUEST_URI"];
        $query_str = parse_url($url, PHP_URL_QUERY);
        parse_str($query_str, $query_params);
        $this->search_results = $this->rental_listing_model->filterRentalListing($query_params);
    }

    /**
     * Search Results On Title Field
     * @param type $search_string
     */
    private function getResultsByTitle($search_string) {
        $this->search_string = $search_string;
        $this->search_results = $this->rental_listing_model->searchRentalListings($search_string);
    }

    private function assignViewVariables() {
        foreach ($this->search_results as $result) {
            $this->rental_ids[] = $result['id'];
            $this->rental_id_to_title[$result['id']] = $result['title'];
            $this->rental_id_to_price[$result['id']] = $result['price'];
            $this->rental_id_to_date_posted[$result['id']] = $result['date_posted'];
            $this->rental_id_to_images[$result['id']][] = $this->rental_listing_model->getImages($result['id']);
        }

        $this->rental_ids = array_unique($this->rental_ids);
    }


    public function index() {
        
        //On main search bar @action event , Search only on Title Field.
        if (isset($_POST["rental_search"])) {

            $this->getResultsByTitle($_POST["rental_search"]);
        } else {
            //On filtered action performed,Pass query string to perform selection
            $this->getQueryString();
        }

        
        $this->assignViewVariables();
        require APP . 'view/_templates/header.php';
        require APP . "view/viewSearchResults/index.php";
        require APP . 'view/_templates/footer.php';
    }

}
