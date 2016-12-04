<?php
require APP . 'model/imageUploadsModel.php';
require APP . 'model/rentalListingModel.php';

class RentalListing extends Controller
{
    private $image_model;

    function __construct()
    {
        parent::__construct();

        $this->image_model = new ImageUploadsModel($this->db);
        $this->rental_listing_model = new RentalListingModel($this->db);
    }

    public function index()
    {
        if($_GET)
        {
            $rental_listing_id =  $_GET['rental_listing_id'];;
            if (isset($_GET['back_search_string']))
            {
                $search_string = $_GET['search_string'];
            }
                    
            $image_results = $this->image_model->getAllImages($rental_listing_id);
            
            $rental_listing_description = $this->rental_listing_model->getDescription($rental_listing_id);
            $rental_listing_address = $this->rental_listing_model->getAddress($rental_listing_id);
            $rental_listing_distance = $this->rental_listing_model->getDistance($rental_listing_id);
            $rental_listing_occupants = $this->rental_listing_model->getNumberOfOccupants($rental_listing_id);
            $rental_listing_owner = $this->rental_listing_model->getOwner($rental_listing_id);
            $rental_listing_price = $this->rental_listing_model->getPrice($rental_listing_id);
            $rental_listing_type = $this->rental_listing_model->getType($rental_listing_id);
            $rental_listing_pets = $this->rental_listing_model->arePetsAllowed($rental_listing_id);

            // get latitude, longitude and formatted address
            $data_arr = geocode($rental_listing_address);
            // if able to geocode the address
            if($data_arr){

                $latitude = $data_arr[0];
                $longitude = $data_arr[1];
                $formatted_address = $data_arr[2];
            }
        }

	    // get latitude, longitude and formatted address
        $data_arr = $this->geocode($rental_listing_address);
        // if able to geocode the address
        if($data_arr){

            $latitude = $data_arr[0];
            $longitude = $data_arr[1];
            $formatted_address = $data_arr[2];
        }

        require APP . 'view/_templates/header.php';
        require APP . "view/viewRentalListing/index.php";
        require APP . 'view/_templates/footer.php';
	}
// function to geocode address, it will return false if unable to geocode address
    public function geocode($address){

        // url encode the address
        $address = urlencode($address);

        // google map geocode api url
        $url = "https://maps.google.com/maps/api/geocode/json?address={$address}&key=AIzaSyAXd8KlVO4CH52NrFf1yrWQEbPJAd0Zjg4";
        // get the json response
        $resp_json = file_get_contents($url);
        // decode the json
        $resp = json_decode($resp_json, true);
        // response status will be 'OK', if able to geocode given address
        if($resp['status']=='OK'){

            // get the important data
            $lati = $resp['results'][0]['geometry']['location']['lat'];
            $longi = $resp['results'][0]['geometry']['location']['lng'];
            $formatted_address = $resp['results'][0]['formatted_address'];
            // verify if data is complete
            if($lati && $longi && $formatted_address){

                // put the data in the array
                $data_arr = array();

                array_push(
                    $data_arr,
                    $lati,
                    $longi,
                    $formatted_address
                );

                return $data_arr;

            }else{
                return false;
            }

        }else{
            return false;
        }
    }
}

