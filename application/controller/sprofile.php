<?php
require APP . 'model/sinmodel.php';

class Sprofile extends Controller
{


	function __construct()
    {
        parent::__construct();
        $this->signin_model = new Sinmodel($this->db);

    }
     public function index()
     {
		$this->signin_model->adduserhere();				
		
        require APP . 'view/_templates/header.php';
        require APP . "view/signinfolder/index.php";
        require APP . 'view/_templates/footer.php';
    }
}
