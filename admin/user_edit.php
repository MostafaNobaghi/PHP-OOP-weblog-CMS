<?php
include('includes/header.php');
if(!$session->is_signed_in()) { redirect("login.php");}
?>






<?php
    $message = '';

    if(isset($_GET['id'])){
        $action = 'updated';
        $user = User::find_by_id($_GET['id']);
    } else {
        $user = new User;
        $action = 'creted';
    }
    
    
    
    
    if(isset($_GET['delete'])){
        if($_GET['delete']=='image'){
            if($user->delete_item_image()){
                redirect("user_edit.php?id=$user->id");
            }
        }
    }
    
    
    
    
    if(isset($_POST['update'])){
        $file = $_FILES['file_upload'];

        $user->username   = $_POST['username'];
        $user->password   = $_POST['password'];
        $user->first_name = $_POST['first_name'];
        $user->last_name  = $_POST['last_name'];
        $user->prepare_user_for_update();
        $user->set_file($_FILES['file_upload']);

        if($user->save_items_with_file()){
            $message = "<br>user $action successfully";
            $session->message($message);
//            redirect("users.php?message=$message " );
            redirect("users.php" );

        }else {
            $message = 'there is no change to update or '.implode('<br>', $user->errors);
        }   

    }
?>

<!--    <pre>
        <?php
//        
//        print_r($user);
//        ?>
    </pre>-->



    <!-- Navigation -->
<?php include('includes/nav.php'); ?>
<?php include './includes/templates/photo_modal.php'; 
//print_r($user)?>


    

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
                        Edit user
                    </h1>
                    <div class="col-md-12">
                        
                    <div class="alert alert-success <?php if(empty($sess_message)){echo 'hidden';} ?>"><h3><?php echo "$sess_message"; ?></h3></div>
                        <div class=" <?php if(empty($message)){echo 'hidden';} ?> alert alert-warning" role="alert"><h4><?php  if(isset($message)){echo $message;}; ?></h4></div>
                       
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="col-md-4 col-md-offset-2">

                                
                                <div class="form-group">
                                    <label for="first_name">First name</label>
                                    <input id="first_name" class="form-control" type="text" name="first_name" value="<?php echo $user->first_name; ?>" placeholder="first name">
                                </div>
                                <div class="form-group">
                                    <label for="last_name">Lasst name</label>
                                    <input id="last_name" class="form-control" name="last_name" value="<?php echo $user->last_name; ?>" placeholder="last name">

                                </div>
                                <div class="form-group">
                                    <label for="Username">Username</label>
                                    <input id="Username" class="form-control" type="text" name="username" value="<?php echo $user->username; ?>" placeholder="username">
                                </div>
                                <div class="form-group">
                                    <label for="Password">Password</label>
                                    <input id="Password" class="form-control" type="password" name="password" value="<?php echo $user->password; ?>" placeholder="password">
                                </div>
                                
                                <input type="submit" name="update" value="Update user" class="btn btn-success ">
                                <a id="item-id" href="user_delete.php?id=<?php echo $user->id; ?>" name="remove" class="btn btn-danger pull-right">Remove user</a>
                            </div>

                            
                            <div class="col-md-4">
                                <div class="thumbnail" >
                                    <a href="#" data-toggle="modal" data-target="#photo-library">
                                        <img id="user-image" style="display: block" src="<?php echo $user->item_image(); ?>">
                                    </a>
                                    <div class="text-center row">
                                        <label for="file_upload"><a class=" btn btn-primary"><i class="fa fa-plus"></i> Change picture</a></label>
                                        <input style="display: none" id="file_upload" class="" type="file" name="file_upload" placeholder="userrrrrr_image">
                                        
                                        <a href="user_edit.php?id=<?php echo $user->id; ?>&delete=image" class="btn btn-danger <?php echo empty($user->item_image)? 'disabled':' '; ?>"><i class="fa fa-remove"></i> Remove picture</a>
                                        
                                    </div>
                                </div>       
                            </div>
                            
                            
                            
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

    