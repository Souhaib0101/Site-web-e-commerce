<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="../include/nav.css">  <!-- link css page  --> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />  <!-- font awesome link -->
   
                <title>       </title>
 <nav>
    <?php
    session_start();
    $currentpage = $_SERVER['PHP_SELF'];
    ?>

    <input type="checkbox" id="check">
    <label for="check" class="checkbtn">
      <i class="fas fa-bars"></i>
    </label>
    <label class="logo">Resto</label>

    <?php if(isset($_SESSION['user'])) { ?>

    <ul id="oldMenu">
        <li><a class="<?php if($currentpage == '/myphp/view/User_Navigation/Home.php') echo 'active'; ?> "  href="http://localhost/myphp/view/User_Navigation/Home.php">Accueil</a></li>   <!-- liste adaptable à moyen écran-->
        <li><a class="<?php if($currentpage == '/myphp/view/User_Navigation/Products.php') echo 'active'; ?> " href="http://localhost/myphp/view/User_Navigation/Products.php">Produits</a></li>
        <li><a class="<?php if($currentpage == '/myphp/view/User_Navigation/Coffee.php') echo 'active'; ?> "  href="http://localhost/myphp/view/User_Navigation/Coffee.php#">Sur Café </a></li>
        <li><a href="http://localhost/myphp/view/Both_Navigation/Deconnexion.php" onclick="return confirm('Êtes-vous sûr de déconnecter de votre compte ?')"> Déconnexion </a></li> 
        <li><a id="thecart" href="http://localhost/myphp/view/User_Navigation/cart.php"><i class="fa-solid fa-cart-shopping"></i></a></li> 

    </ul>

    <?php }  else { ?>

      <ul id="oldMenu">
        <li><a class="<?php if($currentpage == '/myphp/view/User_Navigation/Home.php') echo 'active'; ?> "  href="http://localhost/myphp/view/User_Navigation/Home.php">Accueil</a></li>   <!-- liste adaptable à moyen écran-->
        <li><a class="<?php if($currentpage == '/myphp/view/User_Navigation/Products.php') echo 'active'; ?> " href="http://localhost/myphp/view/User_Navigation/Products.php">Produits</a></li>
        <li><a class="<?php if($currentpage == '/myphp/view/User_Navigation/Coffee.php') echo 'active'; ?> "  href="http://localhost/myphp/view/User_Navigation/Coffee.php#">Sur Café</a></li>
        <li><a class="<?php if($currentpage == '/myphp/view/Both_Navigation/Login.php') echo 'active'; ?> "  href="http://localhost/myphp/view/Both_Navigation/Login.php"> Connexion </a></li> 
    </ul>
   

    <?php } ?>
    
    
    

 </nav>


