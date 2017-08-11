
<?php 
include('includes/header.php');
if(!$session->is_signed_in()) {
redirect("login.php");
}

$users = User::find_all();
//echo '<pre>';
//print_r($users);
//echo '</pre>';

//if(isset($_GET['del'])){
//    $del_id = $_GET['item'];
//    $del_user = Photo::find_by_id($del_id);
//    $del_user->delete();
//    redirect(users.php);
//}
//


?>

    <!-- Navigation -->
<?php include('includes/nav.php'); ?>
<?php include('includes/templates/delete_box_modal.php'); ?>

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
                        Userss <small>Statistics Overview</small>
                    </h1>
                    <a class="btn btn-success" href="user_create.php"><i class="fa fa-plus"></i> Create a new user</a>
                    <div class="alert alert-success <?php if(empty($sess_message)){echo 'hidden';} ?>"><h3><?php echo "$sess_message"; ?></h3></div>
                    <div class="col-md-12">
                        <div class="row table-responsive">
                            <table class="table table-hover users_table">
                                <thead>
                                    <th>ID</th>
                                    <th>User image</th>
                                    <th>Username</th>
                                    <th>First name</th>
                                    <th>last name</th>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($users as $user) : ?>
                                        <tr>
                                            <td> <?php echo $user->id; ?></td>
                                            <td class="">
                                                <div class="col-md-12">
                                                    <div class=" user-thumbnail">
                                                        <img class="user-thumbnail rounded" src= '<?php  echo $user->item_image(); ?>' >
                                                    </div>
                                                </div>
                                            </td>
                                            <td> 
                                                <div>
                                                <?php echo $user->username; ?>
                                                </div>
                                                <div class="action_links">
                                                    <!--<a class="btn btn-danger" href="user_delete.php?id=<?php echo $user->id; ?>">Delete</a>-->
                                                    <a class="btn btn-danger" href="user_delete.php?id=<?php echo $user->id; ?>">Delete</a>
                                                    <a class="btn btn-warning" href="user_edit.php?id=<?php echo $user->id; ?>">Edit</a>
                                                    <a class="btn btn-primary" href="">View</a>
                                                </div>

                                            </td>
                                            <td> <?php echo $user->first_name; ?></td>
                                            <td> <?php echo $user->last_name; ?></td>
                                         <tr>

                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
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
<?php include('includes/footer.php') ?>