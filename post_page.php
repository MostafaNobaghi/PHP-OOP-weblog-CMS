<?php include_once "includes/header.php"?>
<?php //if($session->is_signed_in()){ redirect("admin.php");}?>

<?php
require_once './admin/includes/init.php';




//$sql ="SELECT categories.category_title FROM categories
//       ON junk.post_id = '32'
//    ";

    

    



$message = NULL;

if($_GET['id']){
    $id=$_GET['id'];
}  else {
    redirect('index.php');
}




//// Instantiate The current post
$post  = Post::find_by_id($id);
if(empty($post)){
    $message = 'The post not available';
}



// Load and extract saved comments on this post
$comments = Comment::find_the_comments($id);



//// Save a new comment for this post
if(isset($_POST['submit'])){
    $author   = trim($_POST['author']);
    $body     = trim($_POST['body']);
    
    $new_comment = Comment::create_comment($post->id, $author, $body);
    
    if($new_comment && $new_comment->save()){
        redirect("post_page.php?id=$id");
    }  else {
        $message = 'there is some problem';
    }
}//// END Save a new comment for this post






//// Extracts Categories this post belong to
if($post){$categories = $post->extract_categories();}



?>
<?php include_once "includes/navigation.php"; ?>



    <!-- Page Content -->
    <div class="container">


        <div class="row">
                        
                        
                        

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                <div class="categories">
                    <h4 class="">Categories:</h4>
                    <?php foreach ($categories as $category): ?>
                    <a class="label label-info" href="#"><?php echo $category['category_title']; ?></a>
                    <?php endforeach; ?>
                </div>

                <!-- Pager -->
<!--                <ul class="pager">
                    <li class="previous">
                        <a href="#">&larr; Older</a>
                    </li>
                    <li class="next">
                        <a href="#">Newer &rarr;</a>
                    </li>
                </ul>-->
                
                <div class="row"> 
                    <div class="well">
                        <?php if($message): ?>
                        <div class="alert alert-danger" role="alert"><?php echo $message; ?></div>
                        <?php endif; ?>
                        
                        <div class="image thumbnail">
                            <img class="img-responsive " src="admin/<?php echo $post->item_image(); ?>" alt="<?php echo $post->alternate_text; ?>">
                        </div>
                        <div class="text">
                            <h3>
                                <?php echo $post->title; ?>
                            </h3>
                            <p>
                                <?php echo $post->description; ?>
                            </p>
                        </div>
                    </div>

                    <div class="well">
                        <h4>Leave a comment</h4>
                        <form method="post" action="">
                            <div class="form-group">
                                <input class="form-control" name="author" placeholder="author">
                            </div>

                            <div class="form-group">
                                <textarea rows="8" class="form-control" name="body" placeholder="Write a comment"></textarea>
                            </div>

                            <input type="submit" name="submit" class="btn btn-primary">
                        </form>
                    </div>
                    
                    
                    <div class="">
                        <h3>Users comments</h3>
                        <?php foreach ($comments as $comment): ?>
                        <div class="panel panel-info">
                            <div class="panel-heading"><?php echo $comment->author; ?><small class="pull-right"><?php echo $comment->date; ?></small></div>
                            <div class="panel-body">
                            <?php echo $comment->body; ?>
                            </div>
                        </div>
                        
                        <?php endforeach; ?>
                    </div>
                       
                    
                    
                    
                </div>

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include_once "includes/sidebar.php"?>

        </div>
        <div class="clearfix"></div>
        <!-- /.row -->

      <?php include_once "includes/footer.php"?>
