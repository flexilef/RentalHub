<?php
require APP . 'model/rentalListingModel.php';

/**
 * Class Home
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class Home extends Controller
{
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

    private function setSearchResults()
    {
        $this->search_results = $this->rental_listing_model->searchRentalListings('');
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
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/home/index (which is the default page btw)
     */
    public function index()
    {
        $this->setSearchResults();

        $this->sortByPriceDesc();

        $this->assignViewVariables();
        // load views
        require APP . 'view/_templates/header.php';
        require APP . 'view/home/index.php';
        require APP . 'view/_templates/footer.php';
    }

    public function proto_index()
    {
        // load views
        require APP . 'view/_templates/header.php';
        require APP . 'view/home/proto_index.php';
        require APP . 'view/_templates/footer.php';
    }
}
