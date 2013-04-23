<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of forms
 *
 * @author dliddell
 */
class forms {
    
    
    function getInput($name){//function to get data from input fields
        session_start();
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
                $salt = '$2y$11$' . substr(md5(uniqid(rand(), true)), 0, 22);
                $password = CRYPT($password,$salt);               
             }
         else{
            echo "password not set";
            ++$_SESSION['errors'];
         }
      return $password;     
    }
}