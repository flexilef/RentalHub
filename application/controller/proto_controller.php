<?php
require APP . 'model/modelTest.php';

class Proto_Controller extends Controller {
  
  function __construct() {
    parent::__construct();
    
    $this->model = new modelTest($this->db);
  }

  public function index() {
    //$this->model = new modelTest($this->db);
    $results = $this->model->getAllModels();

    require APP . 'view/_templates/header.php';
    require APP . "view/proto_view/proto_index.php";
    require APP . 'view/_templates/footer.php';
  }
  
  public function insertModel() {
    //insert a new model entry to the model_test table
    if(isset($_POST["submit_insert_model"])) {
      //call model to add song
      $name = $_POST["name"];
      $this->model->insertModel($name);
    }
  }
  
  public function getAllModels() {
    //returns all the rows in the model_test table
  }
  
  public function getModel() {
    //returns the models with $name
  }
}

?>