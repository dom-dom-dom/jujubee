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
                 else{
                     session_destroy();
                   }
           $db =null;  
      } //end of if(isset($_POST['register']))
      
      if(isset($_POST['login'])){ //check form submitted                
          session_start();
            require_once 'classes/forms.php';
                
            
                //connect to databaes
                    require_once 'classes/db.php';
                    $c = new db(); 
                    $db = $c ->connect();
                
                
                    $name = array('user','pass'); //input name array
                    $input = new forms();
                    $input -> getInput($name);//parse input fields using array
                    $pass = $input -> checkPassword('users',$db);
                  
                    if($pass){
                        //execute prepared statement
                        require_once 'classes/user.php';
                        $table = 'users';
                        $usr = new user();
                      $user =  $usr -> login_user($pass,$db); 
                        echo "Welcome back, $user!";
                        }
                    else{
                        echo " Please try again.";
                        session_destroy();
                    }
                
           
           $db =null;  
      } //end of if(isset($_POST['login'])){
                
    else{
       if(isset($_SESSION['user'])){
        $user = $_SESSION['user'];
        $email = $_SESSION['email'];
        }
       else{
          $user = "";
          $email = "";
         }
        $pass = "";    
        $loginid='';
        ?>
        
    <div id="container">
     
    <div id ="registeruser">
        <h1>Register</h1>
      
        <form action="index.php" id="frm-register" method="POST">        
            <input type="text" id="user" name="user" value="<?php echo $user ?>" required="required" placeholder="user"/>
            <input type="email" id="email" name="email" value="<?php echo $email ?>" required="required" placeholder="email"/>
            <input type="password" id="pass" name="pass" value="<?php echo $pass ?>" required="required" placeholder="pass"/>
            <input type="submit" id="register" name="register" value="register"/>
     </form>
    </div> <!-- end #registeruser -->
        
    <div id ="loginuser">
        <h1>Login</h1>
      
        <form action="index.php" id="frm-login" method="POST">        
            <input type="text" id="user" name="user" value="<?php echo $user ?>" required="required" placeholder="email"/>          
            <input type="password" id="pass" name="pass" value="<?php echo $pass ?>" required="required" placeholder="pass"/>
            <input type="submit" id="login" name="login" value="Login"/>
            <input type="checkbox" id="remember" name="remember"/> <p id="remember_label">Remember Me</p>
            <p> <a href="#">Forgot Login</a> </p>
        </form>
    </div>  <!-- end #loginuser -->
        
    </div>  <!-- end #container -->
        
    </body>
</html>
 <?php
            }