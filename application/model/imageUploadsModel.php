<?php

class ImageUploadsModel
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

    public function uploadImage($final_image, $image_type, $new_image_size, $rental_listing_id) {
        $sql = "INSERT INTO image_uploads (image_name, image_type, image_size, rental_listing_id)" .
            "VALUES (:image_name, :image_type, :image_size, :rental_listing_id)";

        $query = $this->db->prepare($sql);
        $parameters = array(':image_name' => $final_image, ':image_type' => $image_type, ':image_size' => $new_image_size, 'rental_listing_id' => $rental_listing_id);

        $query->execute($parameters);
    }

    public function getAllImages($rental_listing_id) {
        $sql = "SELECT * FROM image_uploads WHERE rental_listing_id = :rental_listing_id";

        $query = $this->db->prepare($sql);
        $parameters = array(':rental_listing_id' => $rental_listing_id);
        $query->execute($parameters);

        return $query->fetchAll();
    }
}