<?php
include 'includes/init.php';
if(!$session->is_signed_in()) {
redirect("login.php");
}

if(isset($_GET['id'])){
    $id = $_GET['id'];
} else {
    redirect('index.php');
}
if(empty($category_to_delete = Category::find_by_id($id))){
    echo 'nothing to delete';
}  else {
    $category_name = $category_to_delete->category_title;
    if($category_to_delete->delete_category()){
        $session->message("The Category '{$category_name}' has been deleted successfully. ");
        redirect('posts.php');
    }
}

















echo '<pre>';
//echo $picture_file = SITE_ROOT.'admin'.DS.$category_to_delete->upload_directory.DS.$category_to_delete->item_image;
//unlink($picture_file);
//print_r($category_to_delete);
//$category_to_delete->delete();
//redirect('posts.php');
