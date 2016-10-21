<?php

class ModelTest
{
    /**
     * @param object $db A PDO database connection
     */
    function __construct($db)
    {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
    }
	
	public function getAllModels() {
		$sql = "SELECT * FROM model_test";
    
		$query = $this->db->prepare($sql);
		$query->execute();	
    
    return $query->fetchAll();
	}
  
  public function insertModel($name) {
    $sql = "INSERT INTO model_test (model_name)" .
    "VALUES (:name)";
    
    $query = $this->db->prepare($sql);
    $parameters = array(':name' => $name);
    
    $query->execute($parameters);
  }
  
  public function deleteModel($name) {
    $sql = "DELETE FROM model_test  " .
    "WHERE model_name = :name";
    
    $query = $this->db->prepare($sql);
    $parameters = array(':name' => $name);
    
    $query->execute($parameters);
    
    echo "Deleted: " . $name;
  }

    public function uploadImage($imagename) {
        $sql = "INSERT INTO image_uploads (image_name)" .
            "VALUES (:image_name)";

        $query = $this->db->prepare($sql);
        $parameters = array(':image_name' => $imagename);

        $query->execute($parameters);
    }
}