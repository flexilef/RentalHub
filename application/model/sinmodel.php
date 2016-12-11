<?php

/**
 * @author ehsan
 */
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
    public function registerUser($fname, $email, $password, $student, $landlord) {

        //Set ID for Student or LandLord
        //student ID in defination type detail is 4
        // Landlord ID in defination type detail is 15

        $userTypeId = 0;

        if (isset($student)) {
            $userTypeId = 4;
        }
        if (isset($landlord)) {
            $userTypeId = 15;
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
        $sql = "  SELECT us.ID as ID, FULL_NAME , EMAIL, PASSWORD , USER_TYPE_ID, "
                . " CREATED_DATE , dt.DESCRIPTION as USER_TYPE_DESCRIPTION"
                . " FROM users us,defination_type_detail dt"
                . " WHERE EMAIL = :email and PASSWORD= :password and us.USER_TYPE_ID=dt.ID";
        
        $query = $this->db->prepare($sql);
        $parameters = array(':email' => $email, ':password' => $password);

        $query->execute($parameters);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($results)) {
            // check for empty result
            unset($results['password']);
            return $results;
        }
        return NULL;
    }

    /**
     * Update the User Records
     * @param type $fname
     * @param type $lastName
     * @param type $phone
     * @param type $mobile
     * @param type $email
     * @param type $location
     * @param type $password
     * @return Update Status TRUE OR FALSE
     */
    public function update($fname, $lastName, $phone, $mobile, $email, $location, $password) {

        $sql = "UPDATE users 
                    SET ";

        if (!empty($fname) || !empty($lastName)) {
            $sql = $sql . " FULL_NAME='" . $fname . " ". $lastName . "',";
        } else {
            $sql = $sql . " FULL_NAME=FULL_NAME ,";
        }
        if (!empty($email)) {
            $sql = $sql . " EMAIL ='" . $email . "',";
        } else {
            $sql = $sql . " EMAIL=EMAIL,";
        }
        if (!empty($password)) {
            
            $sql = $sql . " PASSWORD='" . md5($password) . "',";
        } else {
            $sql = $sql . " PASSWORD=PASSWORD,";
        }
        if (!empty($phone)) {
            $sql = $sql . " PHONE='" . $phone . "',";
        } else {
            $sql = $sql . " PHONE=PHONE,";
        }
        if (!empty($mobile)) {
            $sql = $sql . " MOBILE='" . $mobile . "',";
        } else {
            $sql = $sql . " MOBILE=MOBILE,";
        }
        if (!empty($location)) {
            $sql = $sql . " LOCATION='" . $location . "'";
        } else {
            $sql = $sql . "LOCATION=LOCATION";
        }


        $sql = $sql . "  WHERE  ID =" . $_SESSION['id'];

       
        $query = $this->db->prepare($sql);

        return $query->execute();
    }

    
  
}
