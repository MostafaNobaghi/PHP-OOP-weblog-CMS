
<?php 
include('includes/header.php');
if(!$session->is_signed_in()) {
redirect("login.php");
}

$photos = Photo::find_all('DESC');
//echo '<pre>';
//print_r($photos);
//echo '</pre>';

//if(isset($_GET['del'])){
//    $del_id = $_GET['item'];
//    $del_photo = Photo::find_by_id($del_id);
//    $del_photo->delete();
//    redirect(photos.php);
//}
//


?>

    <!-- Navigation -->
<?php include('includes/nav.php'); ?>

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
                        Photos <small>Statistics Overview</small>
                    </h1>
                    <div class="alert alert-success <?php if(empty($sess_message)){echo 'hidden';} ?>"><h3><?php echo "$sess_message"; ?></h3></div>
                    <div class="col-md-12">
                        
                        
                        
                        
                        <div class="row">
                            <?php foreach ($photos as $photo) : ?>
                            <div class="div_thumbnail_container text-center col-xs-4 col-sm-4 col-md-2">
                              <a href="#" class="thumbnail square">
                                <img src="<?php  echo $photo->picture_path(); ?>" alt="...">
                              </a>
                                <a href=""><i class="fa fa-search-plus"></i>view</a>
                                <a href="photo_edit.php?id=<?php echo $photo->id; ?>" class="text-warning"><i class="fa fa-edit"></i>edit</a>
                                <a href="photo_delete.php?id=<?php echo $photo->id; ?>" class="text-danger"><i class="fa fa-remove"></i>delete</a>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        
                        
                        
                        
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