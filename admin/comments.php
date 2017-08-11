
<?php 
include('includes/header.php');
if(!$session->is_signed_in()) {
redirect("login.php");
}
if(empty($_GET['id'])){
    $comments = Comment::find_all_comments();
}  else {
    $comments = Comment::find_the_comments($_GET['id']);
}

//
//echo '<pre>';
//print_r($comments);
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
                        Comments <small>Statistics Overview</small>
                    </h1>
                    <div class="alert alert-success <?php if(empty($sess_message)){echo 'hidden';} ?>"><h3><?php echo "$sess_message"; ?></h3></div>
                    <div class=" <?php if(!isset($_GET['message'])){echo 'hidden';} ?> alert alert-success" role="alert"><h4><?php  if(isset($_GET['message'])){echo $_GET['message'];}; ?></h4></div>
                    <div class="col-md-12">
                        <table class="table table-hover users_table">
                            <thead>
                                <th>Date</th>
                                <th>image</th>
                                <th>author</th>
                                <th>body</th>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($comments as $comment):  ?>
                                <?php 
                                
                                if(!$post = Post::find_by_id($comment->post_id)){
                                    $css_class = ' alert alert-danger';
//                                    echo 'sdfsdf';
                                    $post = new Post;
                                    $post->item_image = 'post-placeholder.jpg';
                                    $post->alternate_text = 'this post is deleted';
//                                        continue;
                                }  else {
                                    $css_class = ' ';
                                }
                                ?>
                                <tr class="<?php echo $css_class; ?>">
                                        <td> <?php echo $comment->date; ?></td>
                                        <td class="">
                                            <div class="col-md-12">
                                                <div class=" user-thumbnail">
                                                    <img class="user-thumbnail rounded" src= '<?php  echo $post->item_image(); ?>' >
                                                </div>
                                            </div>
                                        </td>
                                        <td> 
                                            <div>
                                            <?php echo $comment->author; ?>
                                            </div>
                                            
                                        
                                        </td>
                                        <td> <?php echo $comment->body; ?>
                                            <br>
                                            <div class="action_links">
                                                <a class="btn btn-danger" href="comment_delete.php?id=<?php echo $comment->id; ?>">Delete</a>
                                                <!--<a class="btn btn-warning" href="comment_edit.php?id=<?php echo $comment->id; ?>">Edit</a>-->
                                                <a class="btn btn-primary" href="../post_page.php?id=<?php echo $comment->post_id; ?>">View</a>
                                            </div>
                                        </td>
                                     <tr>
                                
                                <?php endforeach; ?>
                            </tbody>
                        </table>
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