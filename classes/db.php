<?php
/**
 * Create database connection
 * 
 * This class is used by CRUD objects for SQL queries
 * 
 * @author Dominic M. Liddell <dominic@dmlwebs.com>
 * @version 1.0
 */
class db {
    
     var $user = '';
     var $pw = '';
     var $db = '';
    
    public function __construct() {
        $this->db='jujubee';
        $this->user='root';
        $this->pw='S7e77en7';
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

//file located in: "document_root/classes/"
