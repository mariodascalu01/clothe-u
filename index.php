<?php
    $page = isset ($_GET["page"]) ? $_GET["page"] : 'homepage.php'; 
?>
<?php include './inc/init.php'?>
<?php include ROOT_PATH . 'template-parts/header.php'?>
        
        <!-- home section starts -->
        <?php include $page ?>
        
    <!-- Footer ------->
<?php include ROOT_PATH . 'template-parts/footer.php'?>
    