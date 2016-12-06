<?php

    /**
     * @author ehsan
     */
     

require APP . 'model/sinmodel.php';

class Sprofile extends Controller {

    function __construct() {
        parent::__construct();

        $this->signin_model = new Sinmodel($this->db);
    }

    public function index() {
        //Execute on Registeration @ActionEvent
        //Validation of the fields must be done via javascript
        // so that errors or missing field option can be shown on
        // the same view.It will prevent extra round trip.

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

            // create an MD5 hash of the password
            $password = md5($password);

            $status = $this->signin_model->registerUser($fname, $email, $password, $student, $landlord);

            if ($status == true) {
                //Register Successfully ,Set the $fname in Session variable
                $this->getSessionID($email, $password);
            } else {
                //Some PopUp Should be called here to display error message
                echo 'Registeration Failed,Please Contact Administrator';
            }

            require APP . "view/signinfolder/index.php";
        }

        //Execute on SignIn @ActionEvent
        if (isset($_POST['sign-in']) && (!empty($_POST['email']) && !empty($_POST['password']))) {

            $email = $_POST['email'];
            $password = $_POST['password'];

            // create an MD5 hash of the password
            $password = md5($password);

            $fname = $_POST['fname'];
            $this->getSessionID($email, $password);
        }

        // Once the sessions variables have been set, redirect them to the current page.
        header('Location: ' . URL . $_POST['url']);
    }

    //Get the Session ID 
    public function getSessionID($email, $password) {
        $userdetail = $this->signin_model->signIn($email, $password);
        if (!empty($userdetail)) {
            // is_auth is important here because we will test this to make sure they can view other pages
            // that are needing credentials.
            $_SESSION['is_auth'] = true;
            $_SESSION['name'] = $userdetail[0]['FULL_NAME']; //Shown on welcome
            $_SESSION['id'] = $userdetail[0]['ID']; //Use to record transactions
        }
    }

    public function logout() {
        unset($_SESSION['name']);
        unset($_SESSION['is_auth']);
        unset($_SESSION['id']);
        session_destroy();

        header('Location: ' . URL);
        //header("Location: ".$_SERVER['REQUEST_URI']);
    }

}
