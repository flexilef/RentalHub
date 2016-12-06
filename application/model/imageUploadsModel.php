<?php
    /**
     * @author osama
     */
     
class ImageUploadsModel {

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
     *   Save the Image to Database;
     *   $final_image : Image Bytes 
     *   $image_type: Type of the Image 
     * 	$new_image_size: Size of the Image 
     * 	$rental_listing_id: Image associated to property 
     */
    public function uploadImage($final_image, $image_type, $new_image_size, $rental_listing_id) {
        
        if (isset($_SESSION['id'])) {
            $loginId=$_SESSION['id'];
        }else{
             $loginId ="ADMIN";
        }

        $sql = "INSERT INTO image_uploads (IMAGE_NAME, IMAGE_TYPE, IMAGE_SIZE, PROPERTY_ID,CREATED_BY)" .
                "VALUES (:image_name, :image_type, :image_size, :property_id , :createdBy)";


        $query = $this->db->prepare($sql);
        $parameters = array(':image_name' => $final_image, ':image_type' => $image_type,
            ':image_size' => $new_image_size, 'property_id' => $rental_listing_id, 'createdBy' => $loginId);

        $query->execute($parameters);
    }

    /**
     *   Search and Get Images associated to Property;
     * 	$rental_listing_id: Image assiciated to property .
     */
    public function getAllImages($rental_listing_id) {

        $sql = "SELECT image_name FROM image_uploads WHERE PROPERTY_ID = :property_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':property_id' => $rental_listing_id);
        $query->execute($parameters);

        return   $result = $query->fetchAll(PDO::FETCH_ASSOC);
    }

}
