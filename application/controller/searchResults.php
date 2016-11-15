<?php
require APP . 'model/rentalListingModel.php';

class SearchResults extends Controller
{
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
    
    private function setSearchResults($search_string) 
    {
        $this->search_string = $search_string;
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
        $this->lowest_price = 'selected';
        usort($this->search_results, function($arrayA, $arrayB) {
            if($arrayA['price'] < $arrayB['price'])
                return -1;
        
            return 1;
        });
    }

    private function sortByPriceAsc()
    {
        $this->highest_price = 'selected';
        usort($this->search_results, function($arrayA, $arrayB) {
            if($arrayA['price'] > $arrayB['price'])
                return -1;

            return 1;
        });
    }
    
    private function sortByTitleDesc()
    {
        $this->alphabetical_title = 'selected';
        usort($this->search_results, function($arrayA, $arrayB) {
            if(strcasecmp($arrayA['title'], $arrayB['title']) < 0)
                return -1;
        
            return 1;
        });
    }

    private function sortByTitleAsc()
    {
        $this->reverse_alphabetical_title = 'selected';
        usort($this->search_results, function($arrayA, $arrayB) {
            if(strcasecmp($arrayA['title'], $arrayB['title']) < 0)
                return -1;

            return 1;
        });
    }
    
    private function sortByDatePostedDesc()
    {
        $this->oldest_date = 'selected';
        usort($this->search_results, function($arrayA, $arrayB) {
            if(strtotime($arrayA['date_posted']) < strtotime($arrayB['date_posted']))
                return -1;
        
            return 1;
        });
    }

    private function sortByDatePostedAsc()
    {
        $this->newest_date = 'selected';
        usort($this->search_results, function($arrayA, $arrayB) {
            if(strtotime($arrayA['date_posted']) > strtotime($arrayB['date_posted']))
                return -1;

            return 1;
        });
    }

    public function index()
    {
        if(isset($_GET['price']))
        {
            if ($_GET['price'] == 'asc'){

                $this->setSearchResults($_GET['search_string']);

                $this->sortByPriceAsc();

                $this->assignViewVariables();
          }
            if ($_GET['price'] == 'desc'){

                $this->setSearchResults($_GET['search_string']);

                $this->sortByPriceDesc();

                $this->assignViewVariables();
            }
        }

        if(isset($_GET['date']))
        {
            if ($_GET['date'] == 'asc'){

                $this->setSearchResults($_GET['search_string']);

                $this->sortByDatePostedAsc();

                $this->assignViewVariables();
            }
            if ($_GET['date'] == 'desc'){

                $this->setSearchResults($_GET['search_string']);

                $this->sortByDatePostedDesc();

                $this->assignViewVariables();
            }
        }

        if(isset($_GET['title']))
        {
            if ($_GET['title'] == 'asc'){

                $this->setSearchResults($_GET['search_string']);

                $this->sortByTitleAsc();

                $this->assignViewVariables();
            }
            if ($_GET['title'] == 'desc'){

                $this->setSearchResults($_GET['search_string']);

                $this->sortByTitleDesc();

                $this->assignViewVariables();
            }
        }

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
