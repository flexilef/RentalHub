<?php

class RentalListingModel
{
    const SEARCH_WEIGHT_TYPE = 4;
    const SEARCH_WEIGHT_ADDRESS = 3;
    const SEARCH_WEIGHT_TITLE = 2;
    const SEARCH_WEIGHT_DESCRIPTION = 1;
        
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
    
    public function getTitle($id)
    {
        $sql = "SELECT title ".
            "FROM rental_listing " .
            "WHERE rental_listing.id = :id";
        
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);
        $query->execute($parameters);
            
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        
        return $result[0]['title'];
    }
    
    public function getDescription($id)
    {
        $sql = "SELECT description ".
            "FROM rental_listing " .
            "WHERE rental_listing.id = :id";
        
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);
        $query->execute($parameters);
            
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        
        return $result[0]['description'];
    }
    
    public function getAddress($id)
    {
        $sql = "SELECT address ".
            "FROM rental_listing " .
            "WHERE rental_listing.id = :id";
        
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);
        $query->execute($parameters);
            
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        
        return $result[0]['address'];
    }
    
    //returns an integer
    public function getPrice($id)
    {
        $sql = "SELECT price ".
            "FROM rental_listing " .
            "WHERE rental_listing.id = :id";
        
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);
        $query->execute($parameters);
            
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        
        return $result[0]['price'];
    }
    
    public function getType($id)
    {
        $sql = "SELECT type ".
            "FROM rental_listing " .
            "WHERE rental_listing.id = :id";
        
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);
        $query->execute($parameters);
            
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        
        return $result[0]['type'];
    }
    
    //Returns an integer
    public function getNumberOfOccupants($id)
    {
        $sql = "SELECT number_occupants ".
            "FROM rental_listing " .
            "WHERE rental_listing.id = :id";
        
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);
        $query->execute($parameters);
            
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        
        return $result[0]['number_occupants'];
    }
    
    //Returns 1 for true, 0 for false
    public function arePetsAllowed($id) 
    {
        $sql = "SELECT allow_animals ".
            "FROM rental_listing " .
            "WHERE rental_listing.id = :id";
        
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);
        $query->execute($parameters);
            
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        
        return $result[0]['allow_animals'];
    }
    
    public function getDatePosted($id)
    {
        $sql = "SELECT date_posted ".
            "FROM rental_listing " .
            "WHERE rental_listing.id = :id";
        
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);
        $query->execute($parameters);
            
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        
        return $result[0]['date_posted'];
    }
    
    //Returns an array of images names associated with a rental listing with id of $id
    public function getImages($id)
    {
        $sql = "SELECT image_name ".
            "FROM image_uploads " .
            "WHERE image_uploads.rental_listing_id = :id";
        
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);
        $query->execute($parameters);
            
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        
        $image_names = array();
        foreach($result as $image)
        {
            $image_names[] = $image['image_name'];
        }
        
        //var_dump($image_names);
        return $image_names;
    }
    
    public function getOwner($id)
    {

    }
    
    public function getDistance($id)
    {
        
    }

/* Example query created:
    SELECT *, 
	(CASE WHEN `rental_listing`.`type` LIKE '%bedroom%' THEN 3 ELSE 0 END +
     CASE WHEN `rental_listing`.`title` LIKE '%bedroom%' THEN 2 ELSE 0 END +
     CASE WHEN `rental_listing`.`description` LIKE '%bedroom%' THEN 1 ELSE 0 END) as Weight   
    FROM `rental_listing`
    HAVING Weight > 0
    ORDER BY Weight DESC
*/
    public function searchRentalListings($search_string)
    {
        if(!empty($search_string))
        {
            $search_tokens = explode(" ", $search_string);
            $parameters = array();
            
            foreach($search_tokens as $keyword)
            {
                $case_type_queries[] = "CASE WHEN rental_listing.type LIKE CONCAT('%', :{$keyword}, '%') THEN " .
                self::SEARCH_WEIGHT_TYPE . " ELSE 0 END";
                $case_address_queries[] = "CASE WHEN rental_listing.address LIKE CONCAT('%', :{$keyword}, '%') THEN " .
                self::SEARCH_WEIGHT_ADDRESS . " ELSE 0 END";
                $case_title_queries[] = "CASE WHEN rental_listing.title LIKE CONCAT('%', :{$keyword}, '%') THEN " .
                self::SEARCH_WEIGHT_TITLE . " ELSE 0 END";
                $case_description_queries[] = "CASE WHEN rental_listing.description LIKE CONCAT('%', :{$keyword}, '%') THEN " .
                self::SEARCH_WEIGHT_DESCRIPTION ." ELSE 0 END";
                
                $parameters[':'.$keyword] = $keyword;
            }
        
        
            $sql = "SELECT id, title, price, date_posted, " .
            "(" . implode(" + ", $case_type_queries) .
            "+" . implode(" + ", $case_address_queries) .
            "+" . implode(" + ", $case_title_queries) .
            "+" . implode(" + ", $case_description_queries) .
            ") as Weight " .
            "FROM rental_listing " .
            "HAVING Weight > 0 " .
            "ORDER BY Weight DESC";
            
            //var_dump($search_tokens);
        }
        else
        {
            $sql = "SELECT id, title, price, date_posted " .
            "FROM rental_listing";
            
            $parameters = array();
        }
        
        $query = $this->db->prepare($sql);
        $query->execute($parameters);
        
        //var_dump($sql);
        //var_dump($parameters);
        
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        
        return $results;
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
    
    public function deleteRentalListing($id)
    {
        $sql = "DELETE " .
        "FROM rental_listing " .
        "WHERE rental_listing.id = :id";
        
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);
        
        $query->execute($parameters);
    }
}