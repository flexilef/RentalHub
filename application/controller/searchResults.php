<?php
require APP . 'model/rentalListingModel.php';

class SearchResults extends Controller
{
    private $search_results;
    private $rental_ids;
    private $rental_id_to_title;
    private $rental_id_to_images;
    private $rental_id_to_price;

    function __construct()
    {
        parent::__construct();

        $this->rental_listing_model = new RentalListingModel($this->db);
    }
    
    public function cmp($a, $b)
    {
        if($a['price'] < $b['price'])
            return -1;
        
        return 1;
    }
    
    public function getResults($search_string) 
    {
        $this->search_results = $this->rental_listing_model->searchRentalListings($search_string);              
    }
    
    public function assignValueToVariables()
    {
        $this->rental_ids = array();
        $this->rental_id_to_images = array();
        $this->rental_id_to_title = array();
        $this->rental_id_to_price = array();

        foreach($this->search_results as $result)
        {
            $this->rental_ids[] = $result['id'];
            $this->rental_id_to_title[$result['id']] = $result['title'];
            $this->rental_id_to_price[$result['id']] = $result['price'];
            $this->rental_id_to_images[$result['id']][] = $this->rental_listing_model->getImages($result['id']);
        }

        $this->rental_ids = array_unique($this->rental_ids);
    }

    public function index()
    {
        if(isset($_POST["submit_search"]))
        {
            if(isset($_POST["rental_search"]))
            {
                $this->getResults($_POST["rental_search"]);
                
                //TODO:
                //add sort by functions that call usort according to user action
                //ie. change cmp to sortByPrice()
                //We will have if($_POST['user_action'] == 'sort_by_price') sortByPrice();
                var_dump($this->search_results);
                usort($this->search_results, array($this, "cmp"));
                var_dump($this->search_results);
                
                $this->assignValueToVariables();           
            }
        }

        require APP . 'view/_templates/header.php';
        require APP . "view/viewSearchResults/index.php";
        require APP . 'view/_templates/footer.php';
    }
}
