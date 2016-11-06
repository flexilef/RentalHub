<?php

class RentalListingModel
{
    /**
     * @param object $db A PDO database connection
     */
    function __construct($db)
    {
        try
        {
            $this->db = $db;
        }
        catch (PDOException $e)
        {
            exit('Database connection could not be established.');
        }
    }
    
    public function getDescription($id)
    {
        $sql = "SELECT rental_listing.description ".
            "FROM rental_listing " .
            "WHERE rental_listing.id = :id";
        
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);
        $query->execute($parameters);
            
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        
        return $result['description'];
    }
    
    public function getType($id)
    {
        $sql = "SELECT rental_listing.type ".
            "FROM rental_listing " .
            "WHERE rental_listing.id = :id";
        
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);
        $query->execute($parameters);
            
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        
        return $result['type'];
    }
    
    public function getPrice($id)
    {
        $sql = "SELECT rental_listing.price ".
            "FROM rental_listing " .
            "WHERE rental_listing.id = :id";
        
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);
        $query->execute($parameters);
            
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        
        return $result['price'];
    }
    
    public function getAddress($id)
    {
        $sql = "SELECT rental_listing.address ".
            "FROM rental_listing " .
            "WHERE rental_listing.id = :id";
        
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);
        $query->execute($parameters);
            
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        
        return $result['address'];
    }
    
    //Returns an integer
    public function getNumberOfOccupants($id)
    {
        $sql = "SELECT rental_listing.number_occupants ".
            "FROM rental_listing " .
            "WHERE rental_listing.id = :id";
        
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);
        $query->execute($parameters);
            
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        
        return $result['number_occupants'];
    }
    
    //Returns 1 for true, 0 for false
    public function isPets($id) 
    {
        $sql = "SELECT rental_listing.allow_animals ".
            "FROM rental_listing " .
            "WHERE rental_listing.id = :id";
        
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);
        $query->execute($parameters);
            
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        
        return $result['allow_animals'];
    }
    
    //Returns an associative array of images associated with a rental listing with id of $id
    //To access array of images, use $result = getImages(id); $result['image_name'];
    public function getImages($id)
    {
        $sql = "SELECT image_uploads.image_name ".
            "FROM image_uploads " .
            "WHERE image_uploads.rental_listing_id = :id";
        
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);
        $query->execute($parameters);
            
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getOwner($id)
    {

    }
    
    public function getDistance($id)
    {
        
    }

    /*
    SELECT *, 
	(CASE
    	WHEN `rental_listing`.`type` LIKE '%bedroom%' THEN 1 
     END +
     CASE WHEN `rental_listing`.`title` LIKE '%bedroom%' THEN 2
    END) as Weight
       
FROM `rental_listing`
ORDER BY Weight DESC
*/
    public function improvedSearch($search)
    {
        $keywords = explode(" ", $search);
        var_dump($keywords);
        
        foreach($keywords as $keyword)
        {
            $case_type_queries[] = "CASE WHEN rental_listing.type LIKE CONCAT('%', :keyword, '%') THEN 3 ELSE 0 END";
            $case_title_queries[] = "CASE WHEN rental_listing.title LIKE CONCAT('%', :keyword, '%') THEN 2 ELSE 0 END";
            $case_description_queries[] = "CASE WHEN rental_listing.description LIKE CONCAT('%', :keyword, '%') THEN 1 ELSE 0 END";
            
            $parameters = array(':keyword' => $keyword);
        }
        
        $sql = "SELECT rental_listing.id, rental_listing.title, (" . implode(" + ", $case_type_queries) .
        "+" . implode(" + ", $case_title_queries) .
        "+" . implode(" + ", $case_description_queries) .
        ") as Weight FROM rental_listing ORDER BY Weight DESC";
        
        var_dump($sql);
        
        $query = $this->db->prepare($sql);
        $query->execute($parameters);
        
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    public function searchResults($search)
    {
        $sql = "SELECT rental_listing.id, rental_listing.title, image_uploads.image_name ".
            "FROM image_uploads JOIN rental_listing " .
            "ON image_uploads.rental_listing_id = rental_listing.id " .
            "WHERE rental_listing.title LIKE CONCAT('%', :search, '%')";

        $query = $this->db->prepare($sql);
        $parameters = array(':search' => $search);
        $query->execute($parameters);

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertRentalListing($title, $description, $address, $price, $type, $number_occupants, $allow_animals)
    {
        $sql = "INSERT INTO rental_listing (title, description, address, price, type, number_occupants, allow_animals)" .
        "VALUES (:title, :description, :address, :price, :type, :number_occupants, :allow_animals)";

        $query = $this->db->prepare($sql);
        $parameters = array(':title' => $title, ':description' => $description, ':address' => $address,
        ':price' => $price, ':type' => $type, ':number_occupants' => $number_occupants, ':allow_animals' => $allow_animals);

        $query->execute($parameters);
    }

    public function getLatestId()
    {
        $sql = "SELECT id FROM rental_listing ORDER BY id DESC LIMIT 1";

        $query = $this->db->prepare($sql);
        $query->execute();

        if($query->rowCount() > 0)
            return $query->fetch(PDO::FETCH_COLUMN);

        return 1;
    }
}