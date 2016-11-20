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
    
    /**
	*   Get Property Title on ID;
	*   $id : Property ID 
	*/
    public function getTitle($id)
    {
     	$sql = " SELECT TITLE ".
               " FROM PROPERTY " .
               " WHERE ID = :id";
		
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);
        $query->execute($parameters);
            
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        
        return $result[0]['TITLE'];
    }
    
   /**
	*   Get Property DESCRIPTION on ID;
	*   $id : Property ID 
	*/
	
    public function getDescription($id)
    {
     	
		$sql ="  SELECT DESCRIPTION ".
              "  FROM PROPERTY " .
              "  WHERE ID = :id";	
        
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);
        $query->execute($parameters);
            
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        
        return $result[0]['DESCRIPTION'];
    }
	
   /**
	* Get Property ADDRESS on ID;
	* $id : Property ID 
	*/
    
    public function getAddress($id)
    {
    		
		$sql=" SELECT ". 
			 " ADDRESS ".
             " FROM " .
		     " PROPERTY PROP ". 
		     " WHERE PROP.ID= :id" ;
        
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);
        $query->execute($parameters);
            
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        
        return $result[0]['ADDRESS'];
    }
    
    /**
	* Get Property PRICES on ID;
	* $id : Property ID 
	*/
    public function getPrice($id)
    {
  
			
		 $sql = " SELECT PRICE ".
                " FROM PROPERTY " .
                " WHERE ID = :id";	
        
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);
        $query->execute($parameters);
            
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        
        return $result[0]['PRICE'];
    }
    
   /**
	* Get Property PRICES on ID;
	* $id : Property ID 
	*/
    public function getType($id)
    {
    
		$sql=" SELECT DT.DESCRIPTION AS TYPE FROM PROPERTY PROPS  , DEFINATION_TYPE_DETAIL DT ".
             " WHERE PROPS.ID=:id " .
             " AND PROPS.PROP_TYPE_ID=DT.ID";	
        
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);
        $query->execute($parameters);
            
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        
        return $result[0]['TYPE'];
    }
    
    /**
	* Get Available Occupants on ID;
	* $id : Property ID 
	*/
    public function getNumberOfOccupants($id)
    {
        $sql = " SELECT NUMBER_OCCUPANTS ".
               " FROM PROPERTY  " .
               " WHERE ID= :id";
	    
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);
        $query->execute($parameters);
            
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        
        return $result[0]['NUMBER_OCCUPANTS'];
    }
    
	/**
	* Check If Animal is Allowed or Not ;
	* $id : Property ID 
	* Returns 1 for true, 0 for false
    */
    public function arePetsAllowed($id) 
    {
   	
		$sql = " SELECT (CASE WHEN (IS_PET_ALLOWED='Y') THEN 1 ELSE 0 END ) AS ALLOW_ANIMALS ".
               " FROM PROPERTY " .
               " WHERE ID = :id";
        
		
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);
        $query->execute($parameters);
            
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        
        return $result[0]['ALLOW_ANIMALS'];
    }
    
   /**
	* Get the Posted date of the Property ;
	* $id : Property ID 
    */
	
    public function getDatePosted($id)
    {
     	$sql = " SELECT CREATED_DATE AS DATE_POSTED ".
               " FROM PROPERTY " .
               " WHERE ID = :id";
			   
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);
        $query->execute($parameters);
            
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        
        return $result[0]['DATE_POSTED'];
    }
    
    
	/**
	* Returns an array of images names associated with a rental listing with id of $id
	* $id : Property ID 
    */
    public function getImages($id)
    {
        $sql = " SELECT IMAGE_NAME  ".
               " FROM IMAGE_UPLOADS " .
               " WHERE PROPERTY_ID = :id";
			   
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);
        $query->execute($parameters);
            
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        
        $image_names = array();
        foreach($result as $image)
        {
            $image_names[] = $image['IMAGE_NAME'];
        }
        
        //var_dump($image_names);
        return $image_names;
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
	

	/**
	* Insert Property Details 
	* $id : Property ID 
    */
    public function insertRentalListing($title, $description, $address, $price, $type, $number_occupants, $allow_animals)
    {
		//This Line will be Replaced by the Session ID of the User in Future
		$loginId='ADMIN';
		
		if($allow_animals==1){ //Check Whether Is_Pet Allowed Or Not
		    	$pet_allowed='Y';
		}else{
				$pet_allowed='N';
		}
		
		$sql = " INSERT INTO PROPERTY (USER_ID,TITLE, DESCRIPTION ,	ADDRESS, PRICE, 
		         PROP_TYPE_ID  ,NUMBER_OCCUPANTS , IS_PET_ALLOWED )" .
               " VALUES (:userId,:title, :description, :address, :price, :type, :number_occupants, :allow_animals)";

        $query = $this->db->prepare($sql);
		
        $parameters = array(':userId' => $loginId,':title' => $title, ':description' => $description, ':address' => $address,
        ':price' => $price, ':type' => $type, ':number_occupants' => $number_occupants, ':allow_animals' => $pet_allowed);

        $query->execute($parameters);
    }
	
	/**
	* Get Rental Type from DEFINATION_TYPE_DETAIL
	* $type : Type of the Property i.e Bedroom ,Apartment 
    */
	public function getRentalType($type){
		
		$sql = "SELECT ID FROM DEFINATION_TYPE_DETAIL  DT WHERE UPPER(DT.DESCRIPTION) =UPPER(:type)";
		
		$query = $this->db->prepare($sql);
        $parameters = array(':type' => $type);
        $query->execute($parameters);
            
        if($query->rowCount() > 0)
            return $query->fetch(PDO::FETCH_COLUMN);

		//Default Values of N/A (not define)
        return 0;
	}

	/**
	* Get the Auto Increment Property 
	* $id : Property ID 
    */
    public function getLatestId()
    {
        $sql = "SELECT ID FROM PROPERTY ORDER BY ID DESC LIMIT 1";

        $query = $this->db->prepare($sql);
        $query->execute();

        if($query->rowCount() > 0)
            return $query->fetch(PDO::FETCH_COLUMN);

        return 1;
    }
    
	/**
	* Delete the Property 
	* $id : Property ID 
    */
    public function deleteRentalListing($id)
    {
        $sql = "DELETE " .
        "FROM PROPERTY " .
        "WHERE ID = :id";
        
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);
        
        $query->execute($parameters);
    }
	
	
	
    public function getOwner($id)
    {

    }
    
    public function getDistance($id)
    {
        
    }
}