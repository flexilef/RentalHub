<?php

class RentalListingModel {

    const SEARCH_WEIGHT_TYPE = 4;
    const SEARCH_WEIGHT_ADDRESS = 3;
    const SEARCH_WEIGHT_TITLE = 2;
    const SEARCH_WEIGHT_DESCRIPTION = 1;

    /**
     * @param object $db A PDO database connection
     */
    function __construct($db) {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
    }

    /**
     *   Get Property Title on ID;
     *   $id : Property ID 
     */
    public function getTitle($id) {
        $sql = "  SELECT TITLE " .
                " FROM property " .
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
    public function getDescription($id) {

        $sql = "  SELECT DESCRIPTION " .
                "  FROM property " .
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
    public function getAddress($id) {

        $sql = " SELECT " .
                " ADDRESS " .
                " FROM " .
                " property PROP " .
                " WHERE PROP.ID= :id";

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
    public function getPrice($id) {


        $sql = " SELECT PRICE " .
                " FROM property " .
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
    public function getType($id) {

        $sql = " SELECT DT.DESCRIPTION AS TYPE FROM property PROPS  , defination_type_detail DT " .
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
    public function getNumberOfOccupants($id) {
        $sql = " SELECT NUMBER_OCCUPANTS " .
                " FROM property  " .
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
    public function arePetsAllowed($id) {

        $sql = " SELECT (CASE WHEN (IS_PET_ALLOWED='Y') THEN 1 ELSE 0 END ) AS ALLOW_ANIMALS " .
                " FROM property " .
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
    public function getDatePosted($id) {
        $sql = " SELECT CREATED_DATE AS DATE_POSTED " .
                " FROM property " .
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
    public function getImages($id) {
        $sql = " SELECT IMAGE_NAME  " .
                " FROM image_uploads " .
                " WHERE PROPERTY_ID = :id";


        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);
        $query->execute($parameters);

        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        $image_names = array();
        foreach ($result as $image) {
            $image_names[] = $image['IMAGE_NAME'];
        }

        return $image_names;
    }

    /**
     * Search on @Title Property
     * @param type $search_string
     * @return type Arrays
     */
    public function searchRentalListings($search_string) {

     
        if (empty($search_string)) {
            $search_string = '';
        }
        $sql = " SELECT id , title , price , CREATED_DATE as date_posted" .
                " FROM property where upper(TITLE) LIKE upper('%" . $search_string . "%')";
   
        $parameters = array();
        $query = $this->db->prepare($sql);
        $query->execute($parameters);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }

    
    /**
     * Filtering the Selected Results
     * @param string $queryParams Query parameters of Filters
     * @return type Array
     */
     public function filterRentalListing($queryParams) {

        $sql = " SELECT id , title , price , CREATED_DATE as date_posted" .
                " FROM property where 1=1";

        if (!empty($queryParams["search_string"])) {
            $sql = $sql . " AND  upper(TITLE) LIKE upper('%" . $queryParams["search_string"] . "%')";
        }
        
        $sql=$sql. " ORDER BY ";

        if (isset($queryParams["price"])) {
            $sql = $sql . " PRICE " . $queryParams["price"] . " ,";
        }

        if (isset($queryParams["date"])) {
            $sql = $sql . " CREATED_DATE " . $queryParams["date"] . " , ";
        }

        if (isset($queryParams["title"])) {
            $sql = $sql . " TITLE " . $queryParams["title"] . " , ";
        }
        
        $sql=$sql. " ID";

        $parameters = array();
        $query = $this->db->prepare($sql);
        $query->execute($parameters);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }


    /**
     * Insert Property Details 
     * $id : Property ID 
     */
    public function insertRentalListing($title, $description, $address, $price, $type, $number_occupants, $allow_animals) {
      
        if (isset($_SESSION['id'])) {
            $loginId = $_SESSION['id'];
        } else {
            $loginId = "ADMIN";
        }

        if ($allow_animals == 1) { //Check Whether Is_Pet Allowed Or Not
            $pet_allowed = 'Y';
        } else {
            $pet_allowed = 'N';
        }

        $sql = " INSERT INTO property (USER_ID,TITLE, DESCRIPTION ,ADDRESS, PRICE, 
		         PROP_TYPE_ID  ,NUMBER_OCCUPANTS , IS_PET_ALLOWED )" .
                " VALUES (:userId,:title, :description, :address, :price, :type, :number_occupants, :allow_animals)";

        $query = $this->db->prepare($sql);

        $parameters = array(':userId' => $loginId, ':title' => $title, ':description' => $description, ':address' => $address,
            ':price' => $price, ':type' => $type, ':number_occupants' => $number_occupants, ':allow_animals' => $pet_allowed);

        $query->execute($parameters);
    }

    /**
     * Get Rental Type from DEFINATION_TYPE_DETAIL
     * $type : Type of the Property i.e Bedroom ,Apartment 
     */
    public function getRentalType($type) {

        $sql = "SELECT ID FROM defination_type_detail  DT WHERE UPPER(DT.DESCRIPTION) =UPPER(:type)";

        $query = $this->db->prepare($sql);
        $parameters = array(':type' => $type);
        $query->execute($parameters);

        if ($query->rowCount() > 0)
            return $query->fetch(PDO::FETCH_COLUMN);

        //Default Values of N/A (not define)
        return 0;
    }

    /**
     * Get the Auto Increment Property 
     * $id : Property ID 
     */
    public function getLatestId() {
        $sql = "SELECT ID FROM property ORDER BY ID DESC LIMIT 1";

        $query = $this->db->prepare($sql);
        $query->execute();

        if ($query->rowCount() > 0)
            return $query->fetch(PDO::FETCH_COLUMN);

        return 1;
    }

    /**
     * Delete the Property 
     * $id : Property ID 
     */
    public function deleteRentalListing($id) {
        $sql = "DELETE " .
                "FROM property " .
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
