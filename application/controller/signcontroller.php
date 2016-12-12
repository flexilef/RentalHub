<?php

require APP . 'model/sinmodel.php';

 /**
  * @author ehsan
  */
class Signcontroller extends Controller
{


    function __construct()
    {
        parent::__construct();
        $this->signin_model = new sinmodel($this->db);

    }
    
    public function index()
    {
		
		
		if (isset($_POST['register']) ) 
		{
			
		$email = $_POST['email']; 
		$password = $_POST['password']; 
		$verify = $_POST['verify-password']; 
		$student = $_POST['registration-type-student']; 
		$landlord = $_POST['registration-type-landlord']; 
		
		$query = "INSERT INTO users (email,password,verifypassword,student,landlord) VALUES ('$email','$password','$verify','$student','$landlord')"; 
		$data = mysql_query ($query) or die(mysql_error()); 
			
		if($data) 
			{ 
			echo "YOUR REGISTRATION IS COMPLETED..."; 
			} 
		
		} 


		
        require APP . 'view/_templates/header.php';
        require APP . "view/signinfolder/index.php";
        require APP . 'view/_templates/footer.php';
    }


}

?>
