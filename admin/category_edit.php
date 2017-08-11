<?php
include('includes/header.php');

if(!$session->is_signed_in()) { redirect("login.php");}
?>
<?php
$message = '';



if(isset($_GET['id'])){
    $id = $_GET['id'];
    $category = Category::find_by_id($id);
}  else {
    redirect("categories.php");
}





$posts = $category->extract_posts();


if(isset($_POST['submit'])){    
    $category->category_title   = $_POST['category_title'];

    if($category->save()){
        $session->message("Category $action successfully");
        redirect("categories.php");
    } else {
        $message = 'error';
    }
    
}


?>

    <!-- Navigation -->
<?php include('includes/nav.php'); ?>
    
    <pre>
        <?php
         print_r($posts);
        ?>
    </pre>
    

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
                        New category:
                    </h1>
                    <div class="col-md-8">
                        <h3><?php echo $message; ?></h3>
                        <form action="" method="post" >
                            <div class="form-group">
                                <label for="category_title">Category name</label>
                                <input id="category_title" class="form-control" type="text" name="category_title" value="<?php echo $category->category_title ?>" placeholder="category name">
                            </div>
                            
                            
                            
                            <input class="btn btn-success" type="submit" name="submit">
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

    