<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of users
 *
 * @author dliddell
 */
class user {
    
    public function __construct() {
         $this->table ='users';     
          }
    
    function register_user($pass,$registered,$db){      
        $stmt = $db->prepare("INSERT INTO $this->table (username,email,password,registered) 
            VALUES (?,?,?,?)");
        $stmt->bindParam(1, $_SESSION['user']);
        $stmt->bindParam(2, $_SESSION['email']);
        $stmt->bindParam(3, $pass);
        $stmt->bindParam(4, $registered);
        
        if($stmt->execute()){//run statement and evaluate success
            //if success, send confirmation
            echo "Thank you for your registration. You will receive an email with your login details."; 
            return 1;
        }
        else{
            echo "Registration was not successful.";
            return 0;
        }
        
    }
    
    function get_all_users($db){ //get all registered users
        $stmt = $db->query("SELECT username,email,$id FROM $this->table");
        $results = $stmt->fetchAll();
        //use $results
        
        if($results){//run statement and evaluate success
            return $results;
            }
        else{
            return 0;
        }
        
    }
    
    function get_single_user($db){ //get a single user details
        $stmt = $db->query("SELECT username,email FROM $this->table WHERE id= ?");
        $stmt->bindParam(1, $id);
        $results = $stmt->fetchAll();
        
        if($results){//run statement and evaluate success
           return $results;
            }
        else{
            return 0;
        }
        
    }
    
    function edit_user($db,$id,$usr,$eml){  //edit single user
        $stmt = $db->prepare("UPDATE $this->table  SET username=?, email=? WHERE id = ? LIMIT 1");
        $results = $stmt->execute(array($usr,$eml,$id));
             
        if($results){//run statement and evaluate success
            return $results;
            }
        else{
            return 0;
        }
    }
    
    function delete_user($db,$id){ //delete single user from database
        $stmt = $db->prepare("DELETE FROM $this->table WHERE id = ? LIMIT 1");
        $stmt->bindParam(1, $id);
        $results = $stmt->execute();
        
        if($results){//run statement and evaluate success
            return $results;
            }
        else{
            return 0;
        }
              
    }
    
}

?>
