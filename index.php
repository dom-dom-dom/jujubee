<!DOCTYPE html>
<html>
    
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Jujubee</title>
        <link rel="stylesheet" type="text/css" href="css/style.css" media="all"/>  
    </head>
    
    <body>
        <?php
        //process registration form
        $errors = 0;
        
        if(isset($_POST['register'])){ //check form submitted                
                
            require_once 'classes/forms.php';

                $name= array('user','email','pass'); //input name array
                $input = new forms();
                $input -> getInput($name);//parse input fields using array
                $registered = date("Y-m-d H:i:s");
                $pass = $input -> encryptPassword();

                if($_SESSION['errors'] == 0){     
                    //connect to databaes
                    require_once 'classes/db.php';
                    $c = new db(); 
                    $db = $c ->connect();

                    //execute prepared statement
                    require_once 'classes/user.php';
                    $table = 'users';
                    $usr = new user();
                    $usr -> register_user($pass,$registered,$db);                   
                   }
           
           $db =null;  
      } //end of if(isset($_POST['register'])){
                
    else{
        session_start();
        $user = $_SESSION['user'];
        $email = $_SESSION['email'];
        $pass = "";           
        ?>
        
        <h1>Register</h1>
      
        <form action="index.php" id="frm-register" method="POST">        
            <input type="text" id="user" name="user" value="" required="required" placeholder="user"/><br/><br/>
            <input type="email" id="email" name="email" value="" required="required" placeholder="email"/><br/><br/>
            <input type="password" id="pass" name="pass" value="" required="required" placeholder="pass"/><br/><br/>
            <input type="submit" id="register" name="register" value="register"/><br/><br/>
        </form>
       
        
    </body>
</html>
 <?php
            }