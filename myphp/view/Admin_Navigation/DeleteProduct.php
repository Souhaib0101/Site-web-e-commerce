<?php 
        $opt3 = 'active';
        require_once '../include/navadmin.php'  
?> 

<?php
    require_once '../../model/database.php';
    $id = $_GET['id'];
    $sqlState = $cnx->prepare('DELETE FROM products WHERE id=?');
    $delete = $sqlState->execute([$id]);
    header('location: ProductsList.php');
?>

