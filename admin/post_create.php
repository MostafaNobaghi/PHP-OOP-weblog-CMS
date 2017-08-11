<?php
include('includes/header.php');

$categories = Category::find_all();
if(!$session->is_signed_in()) { redirect("login.php");}
?>
<?php
$message = '';



if(isset($_POST['submit'])){
    if(isset($_POST['id'])){
        $action = 'updated';
        $post = Post::find_by_id($_POST['id']);
    } else {
        $post = new Post;
        $action = 'Posted';
    }
    
    $post->title              = $_POST['title'];
    $post->description        = $_POST['description'];
    $post->publisher          = $session->user_id;
    $post->date               = date("Y/m/d H:i:s");
    $post->set_file($_FILES['file_upload']); 
    if($post->save_items_with_file()){
        $message = "Photo $action successfully";
        $session->message($message);
        
//        $post->set_categories();
        redirect("posts.php?message=$message ");
    } else {
        $message = join('<br>', $post->errors);
    }
    if(isset($_POST['category'])){
        $selected_categories = $_POST['category'];
        foreach ($selected_categories as $cat) {
            

            Junk::set_categories($post->id, $cat);
        }
    }
}


?>

    <!-- Navigation -->
<?php include('includes/nav.php'); ?>

<?php include './includes/templates/photo_modal_post.php'; ?>
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
                        New post
                    </h1>
                    <form class="form-group" action="post_create.php" method="post"  enctype="multipart/form-data">
                    <div class="col-md-8">

                        
                        <div class=" <?php if(empty($message)){echo 'hidden';} ?> alert alert-danger" role="alert"><h3><?php  echo $message; ?></h3></div>
                        <div class="row">
                            
                                <a href="plugins/tinymce/plugins/filemanager/dialog.php?type=0&editor=mce_0&lang=eng&fldr=" class="btn iframe-btn" type="button">Open Filemanager</a>
                                <div class="form-group">
                                    <input class="form-control" type="text" name="title" placeholder="title">
                                </div>
                                

                                

                                <div class="form-group custom-textarea"> 
                                    <!--<textarea class="form-control" name="description" placeholder="description"></textarea>-->
                                    
                                    
                                    <div class="custom-textarea">
                                        <!-- <a data-toggle="modal" data-target="#photo-modal-post" class="btn btn-mini btn-info"><i class="fa fa-camera "></i> <i class="fa fa-plus-circle "></i> Insert Picture</a>
                                        <button class="btn btn-mini btn-info"><i class="glyphicon glyphicon-menu-left"></i>Div<i class="glyphicon glyphicon-menu-right"></i></button>
                                        <button class="btn btn-mini btn-info"><i class="glyphicon glyphicon-menu-left"></i>P<i class="glyphicon glyphicon-menu-right"></i></button>-->
                                        
                                        <textarea class="form-control" id="txta" name="description"> </textarea>
                                  </div>

                                </div>
                               

                                <input class="btn btn-success form-control" type="submit" name="submit">
                            
                        </div> <!-- End of row -->
                        <div class="row">
                            <!--<form action="upload" id="my-awesome-dropzone" class="dropzone needsclick dz-clickable"></form>-->
                        </div>
                    </div>
                        <div class="col-md-4">
                            <div class="post-info-box side_style" >
                                        <div class="info-box-header">
                                            <h4>Save <span id="toggle" class="glyphicon glyphicon-menu-up pull-right"></span></h4>   
                                        </div>

                                        <div class="inside">
                                            <div class="box-inner">
                                                

                                               

                                                <p class="text">
                                                   Filename: <span class="data "><?php ?></span>
                                                </p>


                                                
                                                    
                                                   <div class="input-group">
                                                       <p class="text">Categories:</p>
                                                        <?php foreach ($categories as $category): ?>
                                                        <input type="checkbox" name="category[]" value="<?php echo $category->id; ?>"> <?php echo $category->category_title; ?><br>
                                                        <?php endforeach; ?>
                                                    </div>
                                               


                                                <p class="text">
                                                   File Size: <span class="data "><?php   ?></span>
                                                </p>

                                            </div> 


                                            <div class="info-box-footer clearfix">
                                                
                                            </div>
                                        </div>
                                    </div> 
                            
                             <div class="form-group">
                                    <label class="btn btn-info" for="file_upload"><i class="fa fa-image"></i>   Upload     a cover image</label>
                                    <input id="file_upload" class="hidden" type="file" name="file_upload">
                                </div>
                        </div>
                    </form>
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

    