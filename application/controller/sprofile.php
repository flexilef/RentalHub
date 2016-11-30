<?php

require APP . 'model/sinmodel.php';

class Sprofile extends Controller {

    function __construct() {
        parent::__construct();

        $this->signin_model = new Sinmodel($this->db);
    }

    public function index() {
        //Execute on Registeration @ActionEvent
        if (isset($_POST['register'])) {
            $status = false; //Query Status 
            $fname = $_POST['fname'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $verify = $_POST['verifyPassword'];

            $landlord = NULL;
            $student = NULL;

            if (isset($_POST['student'])) {
                $student = $_POST['student'];
            }
            if (isset($_POST['landLord'])) {
                $landlord = $_POST['landLord'];
            }

            $status = $this->signin_model->registerUser($fname, $email, $password, $verify, $student, $landlord);

            if ($status == true) {
                //Register Successfully ,Set the $fname in Session variable
                $this->getSessionID($email, $password);
            } else {
                //Show Warning to User
                echo 'Registeration Failed,Please Contact Administrator';
            }
            
            require APP . "view/signinfolder/index.php";
        }

        //Execute on SignIn @ActionEvent
        if (isset($_POST['sign-in']) && (!empty($_POST['email']) && !empty($_POST['password']))) {
            
            $email = $_POST['email'];
            $password = $_POST['password'];
            $fname = $_POST['fname'];
            $this->getSessionID($email, $password);
        
        }
   
        //This is hardCoded,Will be change in Future
        header('Location: http://localhost/Property/index.php');
//        require APP . 'view/_templates/header.php';
//        require APP . 'view/_templates/footer.php';
    }

    //Get the Session ID 
    //Function allows perform Login Operation
    public function getSessionID($email, $password) {
        $userdetail = $this->signin_model->signIn($email, $password);
        if (!empty($userdetail)) {
            $_SESSION['name'] = $userdetail[0]['FULL_NAME'];
            $_SESSION['id'] = $userdetail[0]['ID'];
        }
    }

    public function logout() {
        unset($_SESSION['name']);
        session_destroy();
        //header("Location: ".$_SERVER['REQUEST_URI']);
        //exit;
    }

}
