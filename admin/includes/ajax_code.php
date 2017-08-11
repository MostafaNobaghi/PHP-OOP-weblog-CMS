<?php
require_once 'init.php';

if(isset($_POST['image_name'])){
    $user_id    = $_POST['user_id'];
    $item_image = $_POST['image_name'];
    $user = User::find_by_id($user_id);
//    $user = new User;
    $user->ajax_save_item_image($item_image, $user_id);
    echo $user->item_image();
}




if(isset($_POST['post_id'])){
    $post_id = $_POST['post_id'];
    
    $post = Photo::find_by_id($post_id);
    if($post) : ?>
<div class="thumbnail">
    <a href="#">
        <img  class="img-responsive" src="<?php echo $post->picture_path(); ?>">
    </a>
    
</div>
    <div class="alert alert-info"><?php echo $post->title; ?></div>
    
<?php endif; 

}?>

    
    
