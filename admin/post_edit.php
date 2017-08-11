<?php
include('includes/header.php');

if(!$session->is_signed_in()) { redirect("login.php");}
?>
<?php
$message = '';
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $post = Post::find_by_id($id);
}  else {
    redirect('posts.php');
}

if(isset($_POST['id'])){
    $post->title              = $_POST['title'];
    $post->description        = $_POST['description'];
    $post->set_file($_FILES['file_upload']);
    if($post->save()){
        $message = "Post updated successfully.";
        $session->message($message);
        redirect("posts.php");
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
                        Edit Post
                    </h1>
                    <a href="" class="thumbnail"><img style="max-height: 450px; width: auto;" src="<?php echo $post->item_image(); ?>" ></a> 
                    <div class="col-md-12">
                        <h3><?php echo $message; ?></h3>
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="col-md-8">
                                        <div class="form-group">
                                            <input class="form-control"  type="text" name="id" value="<?php echo $post->id ?>" readonly="readonly">
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control"  type="text" name="title" placeholder="title" value="<?php echo $post->title ?>" >
                                        </div>



                                        <div class="form-group">
                                            <textarea class="form-control"  name="description" rows="8" placeholder="description"><?php echo $post->description ?></textarea>

                                        </div>
                                </div>


                               <!---------------- RIGHT SIDE ----------------------->                     
                                <div class="col-md-4">
                                    <div class="post-info-box side_style" >
                                        <div class="info-box-header">
                                            <h4>Save <span id="toggle" class="glyphicon glyphicon-menu-up pull-right"></span></h4>   
                                        </div>

                                        <div class="inside">
                                            <div class="box-inner">
                                                <p class="text">
                                                    <span class="glyphicon glyphicon-calendar"></span>  
                                                     Uploaded on:
                                                </p> 

                                                <p class="text">
                                                    Photo Id: <span class="data post_id_box"><?php echo $post->id; ?></span>
                                                </p>

                                                <p class="text">
                                                   Filename: <span class="data "><?php echo $post->item_image; ?></span>
                                                </p>


                                                <p class="text">
                                                   File Type: <span class="data "><?php  ?></span>
                                               </p>


                                                <p class="text">
                                                   File Size: <span class="data "><?php   ?></span>
                                                </p>

                                            </div> 


                                            <div class="info-box-footer clearfix">
                                                <div class="info-box-delete pull-left">
                                                    <a href="post_delete.php?id=<?=$post->id?>" class="btn btn-lg btn-danger">Delete</a>
                                                </div>

                                                <div class="info-box-update pull-right">
                                                   <input type="submit" name="submit" value="Update" class="btn btn-lg btn-success">
                                                </div>
                                            </div>
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
<?php include('includes/footer.php') ?>