<?php

class RentalListingModel
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

    public function searchResults($search) {

        $sql = "SELECT rental_listing.id, rental_listing.title, image_uploads.image_name ".
            "FROM image_uploads JOIN rental_listing " .
            "ON image_uploads.rental_listing_id = rental_listing.id " .
            "WHERE rental_listing.title LIKE CONCAT('%', :search, '%')";

        $query = $this->db->prepare($sql);
        $parameters = array(':search' => $search);
        $query->execute($parameters);

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

  public function insertRentalListing($title) {
    $sql = "INSERT INTO rental_listing (title)" .
    "VALUES (:title)";
    
    $query = $this->db->prepare($sql);
    $parameters = array(':title' => $title);
    
    $query->execute($parameters);
  }
  
  public function getLatestId() {
    $sql = "SELECT id FROM rental_listing ORDER BY id DESC LIMIT 1";
    
    $query = $this->db->prepare($sql);
    $query->execute();
    
    if($query->rowCount() > 0)
      return $query->fetch(PDO::FETCH_COLUMN);
    
    return 1;
  }
}