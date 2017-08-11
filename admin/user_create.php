<?php
include('includes/header.php');

if(!$session->is_signed_in()) { redirect("login.php");}
?>
<?php
$message = '';


if(isset($_POST['submit'])){
    if(isset($_GET['id'])){
        $action = 'updated';
        $user = User::find_by_id($_POST['id']);
    } else {
        $user = new User;
        $action = 'creted';
    }
    
    $user->username   = $_POST['username'];
    $user->password   = $_POST['password'];
    $user->first_name = $_POST['first_name'];
    $user->last_name  = $_POST['last_name'];
    $user->set_file($_FILES['file_upload']);
    if($user->save_items_with_file()){
        $message = "user $action successfully";
        $session->message($message);
        redirect("users.php");
    } else {
        $message = 'error';
    }
    
}


?>

    <!-- Navigation -->
<?php include('includes/nav.php');  ?>
    

    <div id="page-wrapper" class="content-wrapper py-3">

        <div class="container-fluid">

            <!-- Breadcrumbs -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active">My Dashboard</li>
            </ol>
            
            
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Uploads
                    </h1>
                    <div class="col-md-8">
                        <h3><?php echo $message; ?></h3>
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="first_name">First name</label>
                                <input id="first_name" class="form-control" type="text" name="first_name" placeholder="first name">
                            </div>
                            <div class="form-group">
                                <label for="last_name">Lasst name</label>
                                <input id="last_name" class="form-control" name="last_name" placeholder="last name">
                                
                            </div>
                            <div class="form-group">
                                <label for="Username">Username</label>
                                <input id="Username" class="form-control" type="text" name="username" placeholder="username">
                            </div>
                            <div class="form-group">
                                <label for="Password">Password</label>
                                <input id="Password" class="form-control" type="password" name="password" placeholder="password">
                            </div>
                            <div class="form-group">
                                <label for="file_upload">user image</label>
                                <input id="file_upload" class="form-control" type="file" name="file_upload" placeholder="file_upload">
                            </div>
                            
                            
                            <input type="submit" name="submit">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /.content-wrapper -->


    
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fa fa-chevron-up"></i>
    </a>
<?php include('includes/footer.php'); ?>

    