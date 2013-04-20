<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of db
 *
 * @author dliddell
 */
class db {
    
     var $user = '';
     var $pw = '';
     var $db = '';
    
    public function __construct() {
        $this->db = '';
        $this->user =' ';
        $this->pw = '';
    }
    
    function connect(){
                 
       $dbConnect = new PDO('mysql:host=localhost;dbname='. $this->db .';charset=utf8', $this->user , $this->pw);
       if(!$dbConnect){
           echo 'connection failed';
       }
       else{
        return  $dbConnect;
       }
    }
}

?>
