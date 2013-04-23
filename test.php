<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'classes/db.php';
$c = new db(); 
$db = $c ->connect();

require_once 'classes/user.php';
$table = 'users';
$usr = new user();
print_r($usr->delete_user($db,60));   



?>
