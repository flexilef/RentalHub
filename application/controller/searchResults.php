<?php
require APP . 'model/rentalListingModel.php';

class SearchResults extends Controller
{
    private $search_results;
    
    private $rental_ids;
    private $rental_id_to_title;
    private $rental_id_to_price;
    private $rental_id_to_date_posted;
    private $rental_id_to_images;

    function __construct()
    {
        parent::__construct();

        $this->rental_ids = array();
        $this->rental_id_to_title = array();
        $this->rental_id_to_price = array();      
        $this->rental_id_to_date_posted = array();
        $this->rental_id_to_images = array();

        $this->rental_listing_model = new RentalListingModel($this->db);
    }

    public function sortSearchResultsByPrice(){
        if($_GET)
        {
            if ($_GET['price'] == 'desc'){

                $this->sortByPriceAsc();

                $this->assignViewVariables();
            }
        }
    }
    
    private function setSearchResults($search_string) 
    {
        $this->search_results = $this->rental_listing_model->searchRentalListings($search_string);              
    }
    
    private function assignViewVariables()
    {
        foreach($this->search_results as $result)
        {
            $this->rental_ids[] = $result['id'];
            $this->rental_id_to_title[$result['id']] = $result['title'];
            $this->rental_id_to_price[$result['id']] = $result['price'];
            $this->rental_id_to_date_posted[$result['id']] = $result['date_posted'];
            $this->rental_id_to_images[$result['id']][] = $this->rental_listing_model->getImages($result['id']);
        }

        $this->rental_ids = array_unique($this->rental_ids);
    }
    
    private function sortByPriceDesc()
    {
        usort($this->search_results, function($arrayA, $arrayB) {
            if($arrayA['price'] < $arrayB['price'])
                return -1;
        
            return 1;
        });
    }

    private function sortByPriceAsc()
    {
        usort($this->search_results, function($arrayA, $arrayB) {
            if($arrayA['price'] > $arrayB['price'])
                return -1;

            return 1;
        });
    }
    
    private function sortByTitleDesc()
    {
        usort($this->search_results, function($arrayA, $arrayB) {
            if(strcasecmp($arrayA['title'], $arrayB['title']) < 0)
                return -1;
        
            return 1;
        });
    }
    
    private function sortByDatePostedDesc()
    {
        usort($this->search_results, function($arrayA, $arrayB) {
            if(strtotime($arrayA['date_posted']) < strtotime($arrayB['date_posted']))
                return -1;
        
            return 1;
        });
    }

    public function index()
    {
        if(isset($_POST["submit_search"]))
        {
            if(isset($_POST["rental_search"]))
            {
                $this->setSearchResults($_POST["rental_search"]);

                $this->sortByPriceDesc();
                                
                $this->assignViewVariables();           
            }
        }

        require APP . 'view/_templates/header.php';
        require APP . "view/viewSearchResults/index.php";
        require APP . 'view/_templates/footer.php';
    }
}
