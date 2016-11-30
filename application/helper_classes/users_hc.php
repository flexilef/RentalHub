<?php


class Signcontroller extends Controller
{

	private $user_id;
	private $user_type_id;
	private $first_name;
	private $last_name;
	private $dob;
	private $gender_id;
	private $city_id;
	private $country_id;
	private $contact_no;
	private $email;
	private $created_date;
	private $created_by;

    function __construct()
    {
        parent::__construct();


    }
    
    public function index()
    {

    }

	public function getUserId()
	{
		return $user_id;
	}
	public function setUserId(int $user_id)
	{
		$this->$user_id = $user_id;
	}

}

?>
