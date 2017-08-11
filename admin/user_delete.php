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
if(empty($user_to_delete = User::find_by_id($id))){
    $session->message ('no user to delete');
}  else {
    $session->message ("The user {$user_to_delete->username} deleted successfully");
    if($user_to_delete->delete_user()){
        redirect('users.php');
    }
}

















echo '<pre>';
//echo $picture_file = SITE_ROOT.'admin'.DS.$post_to_delete->upload_directory.DS.$post_to_delete->item_image;
//unlink($picture_file);
//print_r($post_to_delete);
//$post_to_delete->delete();
//redirect('posts.php');
