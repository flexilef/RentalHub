<?php
require APP . 'model/modelTest.php';

class Proto_Controller extends Controller {

  public function index() {
    $my_model = new modelTest($this->db);
    $results = $my_model->getAllModels();

    require APP . 'view/_templates/header.php';
    require APP . "view/proto_view/proto_index.php";
    require APP . 'view/_templates/footer.php';
  }
}

?>