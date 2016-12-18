<?php

require APP . 'model/rentalListingModel.php';

 /**
  * @author saad, osama
  */
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
    
    private $house_type;
    private $number_of_occupants;
    private $is_pet_allowed;
    
    private $owner_email;
    
    private $query;

    function __construct() {
        parent::__construct();
        $this->rental_ids = array();
        $this->rental_id_to_title = array();
        $this->rental_id_to_price = array();
        $this->rental_id_to_date_posted = array();
        $this->rental_id_to_images = array();
        $this->rental_listing_model = new RentalListingModel($this->db);
    }
    
    


    public function index() {

        // this will execute when user come back to search result after viewing the result
        if(isset($_GET['back_search_string']))
        {
            $this->getResultsByTitle($_GET['back_search_string']);
        }

        //On main search bar @action event , Search only on Title Field.
        if (isset($_POST["rental_search"])) {

            $_SESSION['rental_search'] = $_POST['rental_search'];
            $this->query=$_POST["rental_search"];
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
    
       public function sendEmail() {
         $ownerEmail = $_REQUEST['email'];

        $mail = new PHPMailer(false); // the true param means it will throw exceptions on errors, which we need to catch

        $mail->IsSMTP(); // telling the class to use SMTP

      
        try {
//            $mail->SMTPDebug = 2;                     // enables SMTP debug information (for testing)
            $mail->From = "fuldaproperty@gmail.com";    // enables SMTP debug information (for testing)
            $mail->FromName = "Property Dealer";
            $mail->Host = "smtp.gmail.com";      // sets GMAIL as the SMTP server
            $mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
            $mail->Port = 465;                   // set the SMTP port for the GMAIL server
            $mail->SMTPAuth = true;                  // enable SMTP authentication
            $mail->Username = "fuldaproperty@gmail.com";  // GMAIL username
            $mail->Password = "echogamma";            // GMAIL password.Donot Misuse it.please keep secret.
            $mail->AddAddress($ownerEmail, '');
            $mail->AddReplyTo($_SESSION['email'], $_SESSION['name']);
            $mail->WordWrap = 50;
            $mail->IsHTML(true);
            $mail->Subject = 'Property  Alert';
            $mail->Body = 'Hello,I am interested in your property.kindly contact me back via email';

            if ($mail->Send()) {
                echo "Message Sent OK</p>\n";
            } else {
                echo "Message Sent Failed</p>\n";
            }
        } catch (phpmailerException $e) {
            echo $e->errorMessage(); //Pretty error messages from PHPMailer
        } catch (Exception $e) {
            echo $e->getMessage(); //Boring error messages from anything else!
        }
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
        
        $_POST["rental_search"]='';
    }

    private function assignViewVariables() {
        foreach ($this->search_results as $result) {
            $this->rental_ids[] = $result['id'];
            $this->rental_id_to_title[$result['id']] = $result['title'];
            $this->rental_id_to_price[$result['id']] = $result['price'];
            $this->rental_id_to_date_posted[$result['id']] = $result['date_posted'];
            $this->rental_id_to_images[$result['id']][] = $this->rental_listing_model->getImages($result['id']);
            $this->owner_email = $this->rental_listing_model->getEmailAddress($result['id']);
        }

        $this->rental_ids = array_unique($this->rental_ids);
    }
}