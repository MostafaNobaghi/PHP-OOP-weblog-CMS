<?php include_once "includes/header.php"?>
<?php //if($session->is_signed_in()){ redirect("admin.php");}?>

<?php
require_once './admin/includes/init.php';




//$sql ="SELECT categories.category_title FROM categories
//       ON junk.post_id = '32'
//    ";

    

    








?>
<?php include_once "includes/navigation.php"; ?>



    <!-- Page Content -->
    <div class="container">
        <pre>
           
        </pre>

        <div class="row">
                        
                        
                        

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                <div class="categories">
                    <h4 class="">About:</h4>
                </div>


                
                <div class="row"> 
                    <div class="well">
                        <?php if($message): ?>
                        <div class="alert alert-danger" role="alert"><?php echo $message; ?></div>
                        <?php endif; ?>
                        
                        
                        <div class="text">

                            <p>
This is a weblog cms project, based on object oriented programming.

this project created using:</p>
                            <ul>
                                <li>PHP</li>
                                <li>MySQL</li>
                            </ul>
                            <p>and also</p>
                            <ul>
                                <li>Java script</li>
                                <li>jquery</li>
                                <li>ajax</li>
                            </ul>
                            
                            
                            
                            <p>you can see the source in my GitHub.</p> 
                            
                        </div> 
                    </div>

                    <div class="well">
                       
                    </div>
                    
                    
                   
                       
                    
                    
                    
                </div>

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include_once "includes/sidebar.php"?>

        </div>
        <div class="clearfix"></div>
        <!-- /.row -->

      <?php include_once "includes/footer.php"?>
