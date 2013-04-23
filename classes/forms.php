<?php
/**
 * Form processing helper objects
 * 
 * Contains:
 * getInput($name) - process input as array
 * encryptPassword() - uses salt and BCRYPT
 * 
 * @author Dominic M. Liddell <dominic@dmlwebs.com>
 * @version 1.0
 */
class forms {
    
    
    function getInput($name){//function to get data from input fields
        
        $_SESSION['errors'] = 0;
              
       foreach($name as $key){//process inputs
            if(isset($_POST[$key])){
                 $data = $_POST[$key];   
                  $_SESSION[$key] = $data; //set session variable
             }
            else{
                 echo "<p>Form Submittal error (No $key field)!</p>\n";
                 ++$_SESSION['errors'];
                 } 
       }
      return 1;
    }


    function encryptPassword(){//check password and encrypt with salt and BCrypt  
        $password='';
         if(isset($_SESSION['pass']))  {
            $password = $_SESSION['pass'];
            $salt = '$2y$11$' . substr(md5(uniqid(rand(), true)), 0, 22);
            $salted = $password.$salt;
            $password = CRYPT($salted);  
            unset($_SESSION['pass']);
             }
         else{
            echo "password not set";
            ++$_SESSION['errors'];
         }
      return $password;     
    }
    
  function checkPassword($table,$db){
       $password='';
         if(isset($_SESSION['pass']))  {
            
            //encode input password
            $password = $_SESSION['pass'];
            $salt = '$2y$11$' . substr(md5(uniqid(rand(), true)), 0, 22);
            $salted = $password.$salt;
            $password = CRYPT($salted);  
            unset($_SESSION['pass']);
            //compare input with saved password for login id
            $loginid = $_SESSION['user'];
              
            $stmt = $db->prepare("SELECT password FROM users WHERE username= ? LIMIT 1");
            $stmt->bindParam(1, $_SESSION['user']);
            $saved = $stmt->fetchColumn();
              
        if(crypt($saved,$password)){//run statement and evaluate success
            return 1;
            }
        else{
            return 0;
        }                    
      }
        else{
           echo "login error";
           ++$_SESSION['errors'];
           return 0;
        }
      }
      
}

//file located in: "document_root/classes/"