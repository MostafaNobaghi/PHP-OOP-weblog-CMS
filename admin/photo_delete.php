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
if(empty($photo_to_delete = Photo::find_by_id($id))){
    echo 'no file to delete';
}  else {
    $photo_name = $photo_to_delete->item_image;
    if($photo_to_delete->delete_photo()){
        $session->message("The photo '{$photo_name}' has been deleted successfully. ");
        $comments = Comment::find_the_comments($id);
        foreach ($comments as $comment) {
            $comment->delete();
        }
        redirect('photos.php');
    }
}

















echo '<pre>';
//echo $picture_file = SITE_ROOT.'admin'.DS.$photo_to_delete->upload_directory.DS.$photo_to_delete->item_image;
//unlink($picture_file);
//print_r($photo_to_delete);
//$photo_to_delete->delete();
//redirect('photos.php');
