<pre>
<?php
require_once 'includes/init.php';

if(!isset($_GET['id'])){
    redirect('comments.php');
}  else {
    $id = $_GET['id'];
    
    $comment_to_delete = Comment::find_by_id($id);
    if($comment_to_delete->delete()){
        $session->message('The comment deleted successfully');
        redirect("comments.php?message=$message");
    }
}

