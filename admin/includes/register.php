<?php
require_once 'header.php';

$message = '';
if(isset($_POST['submit'])){
    $user = new User();
    $user->username   =$_POST['username'];
    $user->password   =$_POST['password'];
    $user->first_name =$_POST['first_name'];
    $user->last_name  =$_POST['last_name'];
    if($user->create()){
        $message = 'register is succesful';
    }  else {
        $message = 'You missed somrthing';
    }
}
?>
<html>
    <head>
        <title>title</title>
    </head>
    <body>
        <form method="post" action="register.php">
            <h3><?php echo $message; ?></h3>
            <input type="text" name="username" placeholder="username"><br>
            <input type="password" name="password" placeholder="password"><br>
            <input type="text" name="first_name" placeholder="First name"><br>
            <input type="text" name="last_name" placeholder="last name"><br>
            <input type="submit" name="submit">
            
        </form>

    </body>
</html>



