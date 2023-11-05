<!-- Part Pre-Produits Start -->
<section class="Pre-Produits">   
    <?php require_once '../include/nav.php' ?> <!-- Fonction appelle nav bar --> 
    <div class="Pre-Titres"> 
        <h2> 
            Vous êtes mal !? N'inquiétez pas <br>
            Une petite tasse vous réparera
        </h2> 
        <p> Grand ou petit, vieux ou jeune, heureux ou triste. Quoi que vous soyez <br>
        Vous devez boire du café Tout le monde a besoin de café </p>
       
      </div>
        
      <div class="beans-img">
         <img  src="../images/Products-Pics/Pre-Products-Beans.png" alt="">
    </div>
</section>

<!-- part two -->



<div >
    <h2 id="title-product" class="mt-5 text-center"> BIENVENUE A NOTRE CAFE </h2>
    <p id="sous-title-product" class="mb-5 text-center"> Click & Drink </p>

<div class="row p-5 m-3">
 
 <?php
    require_once '../../model/database.php';
    $products = $cnx->query('SELECT * FROM products')->fetchAll(PDO::FETCH_ASSOC); // sous 'form' table //
    foreach ($products as $product) {

      $remiseNot = $product['price'] + ($product['price']) * ($product['discount']/100);

      if($product['discount'] > 0){
  ?>

    <div class="col-12 col-sm-8 col-md-6 col-lg-4 mb-4">
      <div class="card" style="border:1px solid #adb5bd;">
        <img class="card-img" src="../images/Products-Pics/products_pictures/<?= $product['filename'] ?>" alt="Coffe">
       
        <div class="card-body" style="border-top:1px solid #adb5bd;">
          <h4 class="card-title"> <?=  $product['product_name'] ?> </h4>
          <h6 class="card-subtitle mb-2 text-muted">quantité : 1kg </h6>
          <p class="card-text">
            <?=  $product['description'] ?>
          </p>
          <!-- price and quant -->
         <form action="cart.php"  method="post">
          <div class=" d-flex justify-content-between align-items-center  ">
         
            <h5 class="text-success mt-4"> <Span id="remise"> <?= $remiseNot . '  ' . 'MAD' ?> </Span> <?=  $product['price'] . ' ' . 'MAD' ?> </h5>
            <input type="number" value="1" class="quantity form-control mt-3 " name="quantity" min="1" max="100">
            <input type="hidden"   name="product_id" value="<?= $product['id'] ?>">
        </div>
       

           <!-- buy btn -->
          <div class="buy d-flex justify-content-between align-items-center">
             <!-- <a href="#" class="btn btn-success mt-3"><i class="fas fa-shopping-cart"></i> Add to Cart</a> -->
             <input type="submit" value="Ajouter" name="add_cart"  class="btn btn-success mt-3" >
             
          </div>
        </form>

        </div>   <!-- end body card -->
      </div>      <!-- end  card -->
   </div>    <!-- end card one -->

   <?php  }  else {  ?>

    <div class="col-12 col-sm-8 col-md-6 col-lg-4 mb-4">
      <div style="border:1px solid #adb5bd;" class="card">
        <img class="card-img" src="../images/Products-Pics/products_pictures/<?= $product['filename'] ?>" alt="Coffe">
      
        <div class="card-body" style="border-top:1px solid #adb5bd;">
          <h4 class="card-title"> <?=  $product['product_name'] ?> </h4>
          <h6 class="card-subtitle mb-2 text-muted">quantité : 1kg </h6>
          <p class="card-text">
            <?=  $product['description'] ?>
          </p>
          <!-- price and quant -->
        <form action="cart.php" method="post">
          <div class=" d-flex justify-content-between align-items-center  ">
         
            <h5 class="text-success mt-4"> <?=  $product['price'] . ' ' . 'MAD' ?> </h5>
            <input type="number" value="1" class="quantity form-control mt-3 " name="quantity" min="1" max="100">
            <input type="hidden" name="product_id" value="<?= $product['id'] ?>"> <!-- recuperer id product -->
          </div>
       

           <!-- buy btn -->
          <div class="buy d-flex justify-content-between align-items-center">
            <input type="submit" value="Ajouter" name="add_cart"  class="btn btn-success mt-3" >
          </div>
          </form>

        </div>   <!-- end body card -->
      </div>      <!-- end  card -->
   </div>    <!-- end card one -->
  

   <?php  } }  ?>

   <!-- deux condition ( deux card) le premier avec remise et le deuxieme sans remise -->

  </div>
</div>


<hr class="section-divider">
<?php require_once '../include/Footer.html' ?>

<link rel="stylesheet" href="../Both_Navigation/WebContent.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
   
