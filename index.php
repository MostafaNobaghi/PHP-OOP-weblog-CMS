<?php include_once "includes/header.php"?>
<?php include_once "includes/navigation.php"?>
<?php






    $page = !empty($_GET['page']) ? $_GET['page'] : (int)1;
    $posts_per_page = 3;
    $posts_total_count = Post::db_row_count();
    
    $paginate = new Paginate($page, $posts_per_page, $posts_total_count);
    
    
    $sql = "SELECT * FROM posts ";
    $sql.= "ORDER BY id DESC ";
    $sql.= "LIMIT {$posts_per_page} ";
    $sql.= "OFFSET {$paginate->offset()}";
    
    
    
    if(isset($_GET['cat_id'])){
    $cat_id = $_GET['cat_id'];
    $category = Category::find_by_id($cat_id);
    $posts = $category->extract_posts();
}  else {
    $posts = Post::find_by_query($sql);
}
            
            
    
?>





    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8"> 
                <h1 class="page-header">
                        Posts <span> </span><small><?php echo isset($category)? 'Category: '.$category->category_title: 'Category: All '; ?></small>
                    </h1>

                
                
                <div class="row">
                    

                        
                        <?php 
                            
                            
                            foreach ($posts as $post): ?>
                            <div class="col-xs-6 col-lg-4">
                                <h2><?php if($post->title == ''){echo 'untitled';}else {echo $post->title;} ?></h2>
                                <div class="thumbnail index-post">
                                    <a href="post_page.php?id=<?php echo $post->id; ?>" >
                                    <img class="img-responsive" src="admin/<?php echo $post->item_image(); ?>">
                                    </a>
                                </div>
                                <!--<p class="post-description">Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>-->
                                <div class="post-description"><p> <?php echo $post->description; ?> </p></div>
                                <p><a class="btn btn-default" href="post_page.php?id=<?php echo $post->id; ?>" role="button">View details »</a></p>
                            </div>
                            
                        <?php endforeach; ?>
                       
                    
                    
                    
                </div>
                
                
                <!-- Pagination ----------------------------------->
                <!-- Pagination ----------------------------------->
                <nav class="text-center" aria-label="Page navigation">
                    <ul class="pagination">

                        <?php 
                        if($paginate->pages_total() > 1){
//                            $previous = (!$paginate->has_previous())? 'disabled' : '' ;
//                            $previous_page = '';
                            
                            if($paginate->has_previous()){
                                $previous_page = 'index.php?page='.$paginate->previous_page();
                                $previous_class = '';
                            }  else {
                                $previous_page = '#';
                                $previous_class = 'disabled';
                            }
                            echo "<li class='previous $previous_class'>";
                            echo "<a class='' href='$previous_page'>";
                            echo "&larr; Older</a></li>";

                            
                            
                            for ($index = 1; $index <= $paginate->pages_total(); $index++) {
                                $pageClass = ($index == $page)? 'active' : '' ;
                                $page_href = ($index == $page)? '#' : "index.php?page=$index";
                                echo "<li class='$pageClass'><a href='$page_href'>$index</a></li> ";
                            }
                            
                            
                            
                            
                            if($paginate->has_next()){
                                $next_page = 'index.php?page='.$paginate->next_page();
                                $next_class = '';
                            }  else {
                                $next_page = '#';
                                $next_class = 'disabled';
                            }
                            
                            echo "<li class='next $next_class'>
                            <a href='$next_page'>
                            Newer &rarr;</a> </li>";
                        }

                        ?>
                    </ul>
                </nav>

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include_once "includes/sidebar.php"?>

        </div>
        <!-- /.row -->

      <?php include_once "includes/footer.php"?>
