<?php
require APP . 'model/modelTest.php';

class Proto_Controller extends Controller {
  
  function __construct() {
    parent::__construct();
    
    $this->model = new modelTest($this->db);
  }

  public function index() {
    $results = $this->model->getAllModels();

    require APP . 'view/_templates/header.php';
    require APP . "view/proto_view/proto_index.php";
    require APP . 'view/_templates/footer.php';
  }
  
  public function insertModel() {
    if(isset($_POST["submit_insert_model"]) 
      && isset($_POST["name"])) {
      $name = $_POST["name"];
      $this->model->insertModel($name);
    }
    
    header('Location:' . URL . 'proto_controller/index');
  }
  
  public function deleteModel() {
    if(isset($_GET["submit_delete_model"]) 
      && isset($_GET["name"])) {
      $name = $_GET["name"];
      $this->model->deleteModel($name);
    }
    
    header("Location:" . URL . "proto_controller/index");
  }

    public function uploadImage() {
        if($_FILES['image']['name'])
        {
            $save_path=APP."uploads/"; // Folder where you wanna move the file.
            $imagename = strtolower($_FILES['image']['name']); //You are renaming the file here
            move_uploaded_file($_FILES['image']['tmp_name'], $save_path.$imagename); // Move the uploaded file to the desired folder
            $this->model->uploadImage($imagename);
        }

        header('Location:' . URL . 'proto_controller/index');
    }
}

?>
