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
$post_to_delete = Post::find_by_id($id);
if(empty($post_to_delete)){
    echo 'no file to delete';
}  else {
    $post_name = $post_to_delete->title;
    if($post_to_delete->delete_post()){
        $session->message("The post '{$post_name}' has been deleted successfully. ");
        $comments = Comment::find_the_comments($id);
        foreach ($comments as $comment) {
            $comment->delete();
        }
        redirect('posts.php');
    }
}

















echo '<pre>';
//echo $picture_file = SITE_ROOT.'admin'.DS.$post_to_delete->upload_directory.DS.$post_to_delete->item_image;
//unlink($picture_file);
//print_r($post_to_delete);
//$post_to_delete->delete();
//redirect('posts.php');
