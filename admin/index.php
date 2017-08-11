<?php include('includes/header.php'); 
        //include('includes/header.php'); 

if(!$session->is_signed_in()) {
redirect("login.php");
}
if(isset($_GET['logout'])){
    $session->logout();
    redirect('login.php');   
}
?>



    <!-- Navigation -->
<?php 
    include('includes/nav.php');
    include('includes/admin_content.php');
    

?>

    <!-- /.content-wrapper -->

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fa fa-chevron-up"></i>
    </a>
<?php include('includes/footer.php') ?>