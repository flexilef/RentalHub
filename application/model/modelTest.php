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
    echo "inserted " . $name . ".";
  }
  
  public function getModel($name) {
    
  }
	
	/*
	public function insertModel() {
		$sql = "INSERT INTO song (artist, track, link) VALUES (:artist, :track, :link)";
        $query = $this->db->prepare($sql);
        $parameters = array(':artist' => $artist, ':track' => $track, ':link' => $link);

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);
	}*/
}