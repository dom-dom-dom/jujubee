<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include 'classes/forms.php';
$name= array('user','email','pass');
$input = new forms();
$input -> getInput($name);



?>
