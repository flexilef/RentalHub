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

    public function uploadImage($final_image, $image_type, $new_image_size) {
        $sql = "INSERT INTO image_uploads (image_name, image_type, image_size)" .
            "VALUES (:image_name, :image_type, :image_size)";

        $query = $this->db->prepare($sql);
        $parameters = array(':image_name' => $final_image, ':image_type' => $image_type, ':image_size' => $new_image_size);

        $query->execute($parameters);
    }

    public function getAllImages() {
        $sql = "SELECT * FROM image_uploads";

        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
}