
<?php 
include('includes/header.php');
if(!$session->is_signed_in()) {
redirect("login.php");
}

$categories = Category::find_all('DESC');
  
//echo '<pre>';
//print_r($categories);
//echo '</pre>';

//if(isset($_GET['del'])){
//    $del_id = $_GET['item'];
//    $del_post = Photo::find_by_id($del_id);
//    $del_post->delete();
//    redirect(posts.php);
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
                        Categories <small>Statistics Overview</small>
                    </h1>
                    
                    <a class="btn btn-success" href="category_create.php"><i class="fa fa-plus"></i> Create a new category</a>
                    <div class="alert alert-success <?php if(empty($sess_message)){echo 'hidden';} ?>"><h3><?php echo "$sess_message"; ?></h3></div>
                    <div class="col-md-12">
                        <div class="row table-responsive">
                            <table class="table table-hover posts_table">
                                <thead>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Posts</th>
                                    <th>Actions</th>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($categories as $category) : ?>
                                        <tr>
                                            <td class=""><?php echo $category->id ?></td>
                                            <td> <?php echo $category->category_title; ?></td>
                                            <td> ...</td>
                                            <td> 
                                                <br>
                                                <div class="action_links row">
                                                    <a class=" btn btn-danger" href="category_delete.php?id=<?php echo $category->id; ?>">Delete</a>
                                                    <a class="btn btn-warning" href="category_edit.php?id=<?php echo $category->id; ?>">Edit</a>
                                                    
                                                    <a class="btn btn-info" href="posts.php?cat_id=<?php echo $category->id; ?>">View posts (<small><?php echo $category->count_post_in_category(); ?>)</small></a>
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
        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /.content-wrapper -->

    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fa fa-chevron-up"></i>
    </a>
<?php include('includes/footer.php') ?>