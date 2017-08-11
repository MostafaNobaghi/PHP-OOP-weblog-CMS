<?php
include('includes/header.php');

if(!$session->is_signed_in()) { redirect("login.php");}
?>
<?php
$message = '';
//if(isset($_POST['submit'])){
//    if(isset($_POST['id'])){
//        $id = $_POST['id'];
//        $photo = Photo::find_by_id($id);
//        $photo->title                = $_POST['title'];
//        $photo->caption              = $_POST['caption'];
//        $photo->alternate_text       = $_POST['alternate_text'];
//        $photo->description          = $_POST['description'];
//        if($photo->save()){
//            $message = 'file edit updateded successfully';
//        }
//}  
//    
//    else {
//        
//    
//        $photo = new Photo;
//        $photo->title              = $_POST['title'];
//        $photo->caption            = $_POST['caption'];
//        $photo->alternate_text     = $_POST['alternate_text'];
//        $photo->description        = $_POST['description'];
//        $photo->set_file($_FILES['file_upload']);
//        if($photo->save()){
//            $message = 'file uploaded successfully';
//        } else {
//            $message = join('<br>', $photo->errors);
//        }
//    }
//}


if(isset($_POST['submit'])){
    if(isset($_POST['id'])){
        $action = 'updated';
        $photo = Photo::find_by_id($_POST['id']);
    } else {
        $photo = new Photo;
        $action = 'uploaded';
    }
    
    $photo->title              = $_POST['title'];
    $photo->caption            = $_POST['caption'];
    $photo->alternate_text     = $_POST['alternate_text'];
    $photo->set_file($_FILES['file_upload']);
    
    if($photo->save()){
        $session->message("Photo $action successfully");
        redirect("photos.php");
    } else {
        $message = join('<br>', $photo->errors);
    }
    
}


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
                        Uploads
                    </h1>
                    <div class="col-md-8">
                        <div class=" <?php if(empty($message)){echo 'hidden';} ?> alert alert-danger" role="alert"><h3><?php  echo $message; ?></h3></div>
                        <div class="row">
                            <form action="uploads.php" method="post"  enctype="multipart/form-data">
                                <div class="form-group">
                                    <input class="form-control" type="text" name="title" placeholder="title">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="text" name="caption" placeholder="caption">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="text" name="alternate_text" placeholder="alternate_text">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="file" name="file_upload">
                                </div>

                                <input type="submit" name="submit">
                            </form>
                        </div> <!-- End of row -->
                        <div class="row">
                            <!--<form action="upload" id="my-awesome-dropzone" class="dropzone needsclick dz-clickable"></form>-->
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
<?php include('includes/footer.php'); ?>

    