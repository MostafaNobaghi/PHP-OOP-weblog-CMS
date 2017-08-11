
<?php 
include('includes/header.php');
if(!$session->is_signed_in()) {
redirect("login.php");
}

if(isset($_GET['cat_id'])){
    $cat_id = $_GET['cat_id'];
    $category = Category::find_by_id($cat_id);
    $posts = $category->extract_posts();
}  else {
    $posts = Post::find_all('DESC');
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
                        Posts <span> </span><small><?php echo isset($category)? 'Category: '.$category->category_title: 'Category: All '; ?></small>
                    </h1>
                    
                    <a class="btn btn-success" href="post_create.php"><i class="fa fa-plus"></i> Create a new Post</a>
                    <div class="alert alert-success <?php if(empty($sess_message)){echo 'hidden';} ?>"><h3><?php echo "$sess_message"; ?></h3></div>
                    <div class="col-md-12">
                        <div class="row table-responsive">
                            <table class="table table-hover posts_table">
                                <thead>
                                    <th>Publish Date</th>
                                    <th>Photo</th>
                                    <th>ID</th>
                                    <!--<th>File name</th>-->
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Categories</th>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($posts as $post) : ?>
                                        <tr>
                                            <td><?php echo $post->date; ?></td>
                                            <td class="">
                                                <div class="col-md-12">
                                                    <div class=" col-md-8">
                                                        <img class="admin-post-thumbnail" src= '<?php  echo $post->item_image(); ?>' >
                                                    </div>
                                                </div>
                                            </td>
                                            <td> <?php echo $post->id; ?></td>
                                            <!--<td> <?php echo $post->item_image; ?></td>-->
                                            <td> <?php echo $post->title; ?></td>
                                            <td> 
                                                <p> <?php echo substr($database->escape_string($post->description), 0, 600); ?> </p>
                                                <br>
                                                <div class="action_links row"> 
                                                    <a class=" btn btn-danger" href="post_delete.php?id=<?php echo $post->id; ?>">Delete</a>
                                                    <a class="btn btn-warning" href="post_edit.php?id=<?php echo $post->id; ?>">Edit</a>
                                                    <a class="btn btn-primary" href="../post_page.php?id=<?php echo $post->id; ?>">View</a>
                                                    <?php $post_comments = Comment::find_the_comments($post->id); ?>
                                                    <a class="btn btn-info" href="comments.php?id=<?php echo $post->id; ?>">Comments (<small><?php echo count($post_comments); ?>)</small></a>
                                                </div>
                                            </td>
                                            <td> <?php  $post->print_categories(); ?></td>
                                            
                                            
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