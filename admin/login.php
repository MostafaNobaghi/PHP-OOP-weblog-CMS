<?php
    require_once 'includes/header.php';
    
    if($session->is_signed_in()){
        redirect('index.php');
    }
    if (isset($_GET['submit'])) {
        $username = trim($_GET['username']);
        $password = trim($_GET['password']);
        /// Method to chek user in database
        $found_user = User::verify_user($username, $password);
        if($found_user){
            $session->login($found_user);
//            echo '<pre> $found_user ';
//            print_r($found_user);
//            echo '</pre>';
            redirect('index.php');
        } else {
            $the_message = 'userbname or passworc is not valid';
        }
} else {
    $the_message = '';
    $username = '';
    $password = '';
}

?>

<?php require_once("includes/header.php");


?>
<div class="container">
<div class="col-md-4 col-md-offset-2">
    
    <div class="alert alert-danger <?php if(empty($the_message)){echo 'hidden';} ?>"><h4><?php echo "$the_message"; ?></h4></div>
    
    <form id="login-form" action="" method="GET">
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" name="username" placeholder="User name" value="<?=htmlentities($username)?>">
    </div>
    <div class="form-group">
        <label for="username">Password</label>
        <input type="text" class="form-control" name="password" placeholder="Password" value="<?=htmlentities($password)?>">
    </div>
    
     <div class="form-group">
       <input type="submit" name="submit" value="Submit" class="btn btn-primary">    
     </div>
    
    </form>
    </div>
</div>