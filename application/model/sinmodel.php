<?php

class Sinmodel {

 
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
     * Register User ,Insert Row in @Table Users
     * @param type $fname
     * @param type $email
     * @param type $password
     * @param type $verify
     * @param type $student
     * @param type $landlord
     * Return: Success or Failure i.e true or false
     */
    public function registerUser($fname, $email, $password, $verify, $student, $landlord) {

        //Set ID for Student or LandLord
        //student ID in defination type detail is 4
        // Landlord ID in defination type detail is 15

        $userTypeId = 0;

        if (isset($student)) {
            $userTypeId = 4;
        }
        if (isset($landlord)) {
            $userTypeId =15;
        }

        $sql = "INSERT INTO users (FULL_NAME,EMAIL,PASSWORD,USER_TYPE_ID)" .
                " VALUES (:fname,:email, :password,:userTypeId)";
        $query = $this->db->prepare($sql);
        
        $parameters = array(':fname' => $fname, ':email' => $email, ':password' => $password,
            ':userTypeId' => $userTypeId);

        return $query->execute($parameters);
    }

    /**
     * SignIn if email and password matches.
     * @param type $email
     * @param type $password
     * @return type Null if result 0 otherwise Result Set
     */
    public function signIn($email, $password) {
       $sql = "SELECT 	ID,FULL_NAME, EMAIL, PASSWORD " . "FROM users " .
                "WHERE EMAIL = :email and PASSWORD= :password";
        $query = $this->db->prepare($sql);
        $parameters = array(':email' => $email, ':password' => $password);
       
        $query->execute($parameters);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        //print_r($results); exit;
        if (!empty($results)) {
            // check for empty result
            unset($results['password']);
            return $results;
        }
        return NULL;
    }

}
