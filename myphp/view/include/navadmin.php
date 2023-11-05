
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../include/navadmin.css">  <!-- link css page  --> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />  <!-- font awesome link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

                <title>        </title>
 <nav class="nav-admin">
  <?php 
    session_start();
    $currentpage =$_SERVER['PHP_SELF'];
   ?>

    <input type="checkbox" id="check">
    <label for="check" class="checkbtn">
      <i class="fas fa-bars"></i>
    </label>
    <label style="font-size:32px; " class="logo">Resto</label>

    <ul id="oldMenu">
        <li><a  class="pge_admn<?php if($currentpage == '/myphp/view/Admin_Navigation/Admin.php') echo ' active'; ?> " href="http://localhost/myphp/view/Admin_Navigation/Admin.php">Administation</a></li>   <!-- liste adaptable à moyen écran-->
        <li><a  class="pge_admn<?php if($currentpage == '/myphp/view/Admin_Navigation/Addproduct.php') echo ' active'; ?> " href="http://localhost/myphp/view/Admin_Navigation/Addproduct.php">Ajouter_Produit</a></li>   <!-- liste adaptable à moyen écran-->
        <li><a  class="pge_admn<?php if($currentpage == '/myphp/view/Admin_Navigation/ProductsList.php') echo ' active'; ?> "  href="http://localhost/myphp/view/Admin_Navigation/ProductsList.php">Liste_Produits</a></li>
        <li><a  class="pge_admn<?php if($currentpage == '/myphp/view/Admin_Navigation/Commandlist.php') echo ' active'; ?> "  href="http://localhost/myphp/view/Admin_Navigation/Commandlist.php">Liste_Commandes </a></li>
        <li><a  class="pge_admn<?php if($currentpage == '/myphp/view/Admin_Navigation/Commanddetails.php') echo ' active'; ?> "  href="http://localhost/myphp/view/Admin_Navigation/Commanddetails.php">Détails_Commandes </a></li>

        <li><a  href="http://localhost/myphp/view/Both_Navigation/Deconnexion.php" onclick="return confirm('Êtes-vous sûr de déconnecter de votre compte?')"> Déconnexion </a></li> 
    </ul>
 </nav>



