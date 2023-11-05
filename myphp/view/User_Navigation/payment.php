<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

<?php require_once '../include/nav.php' ?> 

    <?php
    
    require_once '../../model/database.php';

     
    if(isset($_POST['buy'])){

        if(!empty($_POST['fname']) && !empty($_POST['lname']) && !empty($_POST['city'])  && !empty($_POST['location'])  && !empty($_POST['tel'])) {
            if (is_numeric($_POST['tel'])){
            
            $fname = htmlspecialchars($_POST['fname']);
            $lname = htmlspecialchars($_POST['lname']);
            $location = htmlspecialchars($_POST['location']);
            $city = htmlspecialchars($_POST['city']);
            $tel = htmlspecialchars($_POST['tel']);

            $sqlstatement = $cnx->prepare(query:'INSERT INTO shipping VALUES(null,?,?,?,?,?)'); 
            $sqlstatement->execute([$fname,$lname,$city,$location,$tel]);  

        

      $sqlproduct_command = 'INSERT INTO product_command(id_product,product_name,id_command,price,quantity,price_total) VALUES';
      $command_info = [];

      $id_user = $_SESSION['user']['id'];  
      $username = $_SESSION['user']['username'];
      
      $total = 0;
      foreach($_SESSION['cart'] as $cart_item)   {

        $product_name = $cart_item['product_name'];
        $id_product = $cart_item['id'];
        
        $priceOld = $cart_item['price'];
        $qty = $cart_item['quantity'];
        $priceNew = $priceOld * $qty;
        $total += $priceNew; 
      
        
        $command_info[$id_product] = [
            'id' => $id_product,
            'product_name' => $product_name,
            'price' => $priceOld,
            'price_total' => $qty * $priceOld,
            'qty' => $qty
        ];
      }
    
     
      $date_command = date('Y-m-d H:i:s');

      $stopInsertion = false;  
      if ($total <= 0) {
          $stopInsertion = true;  
      }

      if(!$stopInsertion) {    
            $sqlstate = $cnx->prepare(query:'INSERT INTO command VALUES(null,?,?,?,?)'); 
            $sqlstate->execute([$id_user,$username,$total,$date_command]);  

            $id_command = $cnx->lastinsertid(); // fonction return id command //

            // product_command table //
            foreach ($command_info as $info) {
                $id = $info['id'];
                // . : concaténation //
                $sqlproduct_command .= "(:id$id,:product_name$id,'$id_command',:price$id,:qty$id,:price_total$id),";
              
               
            }
            // fontion lit la requete jusqu'a l'element avant dernier, pour //
            $sqlproduct_command = substr($sqlproduct_command, 0, -1); 
           
            $sqlState = $cnx->prepare($sqlproduct_command);
            foreach ($command_info as $info) {
                $id = $info['id'];
                $sqlState->bindParam(':id' . $id, $info['id']);
                $sqlState->bindParam(':product_name' . $id, $info['product_name']);
                $sqlState->bindParam(':price' . $id, $info['price']);
                $sqlState->bindParam(':qty' . $id, $info['qty']);
                $sqlState->bindParam(':price_total' . $id, $info['price_total']);
            } 
            $inserted = $sqlState->execute();
   
        }

        $_SESSION['cart'] = [] ;
              
                } else {
                ?>
                    <div class="alert alert-warning my-3">
                    le numéro de téléphone doit etre numérique !
                    </div>
                <?php 
                }

         } else {
        ?>
            <div class="alert alert-danger my-3">
            Tous les champs sont obligatoires !
            </div>
        <?php  
        } }
    ?>


<?php if($_SESSION['cart'] != []  ) {  ?>

<body>

<style>
  section{
    background-image:  url(../images/bgnew2.jpg);
    background-size : cover;
    background-position : center;
  }
</style>

<section class="" style=" height: calc(100vh + 150px) ; padding-top:30px; ">

<form style=" background : #ffffff; width:60%;"  class="container my-3 p-4" method="Post">
      
      <div class="row justify-content-center " >
        <div class="col-12 col-md-8 col-lg-8 col-xl-10">
          <div class="row">
            <div class="col text-center">
              <h1 style="color: #black; font-size: 32px; font-weight:bold;"> Paiement à la Livraison </h1>
              <p class="text-h3 ">Entrez vous informations nécessaires pour la livraison</p>
            </div>
          </div>
          
          <div class="row align-items-center">
            <div class="col mt-4">
              <label>Nom :</label>
              <input type="text" class="form-control" id="fname-input"  placeholder="Entrez votre nom" name="fname" >
            </div>

            <div class="col mt-4">
              <label>Prénom :</label>
              <input type="text" class="form-control" id="lname-input" placeholder="Entrez votre nom de famille" name="lname" >
            </div>
          </div>
          
          <div class="row align-items-center mt-4">
            <div class="col">
              <label>Ville:</label>
              <input type="text" class="form-control" placeholder="Entrez votre ville" name="city"   >
            </div>
          </div>

            <div class="row align-items-center mt-4">
                <div class="col">
                    <label>Localisation:</label>
                    <input type="text" class="form-control"  placeholder="Entrez votre localisation" name="location"  >
                </div>
           </div>

           <div class="row align-items-center mt-4">
                <div class="col">
                    <label>Téléphone:</label>
                    <input type="text" class="form-control"  placeholder="Entrez votre téléphone" name="tel"   >
                </div>
           </div>

        <div class="row align-items-center mt-4">
                <div class="col">
                <p>
                   Pour des informations supplémentaires nous devons vous contacter <br>
                   Le délai de livraison est compris entre <b>12h - 24h</b> <br>
                </p>  
                <hr>
                       
           </div>
        </div>

           <?php  
            $total_without = 0;
            foreach($_SESSION['cart'] as $cart_price){
                $total_without += $cart_price['final_price'];
            }
     
              $total_affich = $total_without + 15;
            ?>

          <div class="row justify-content-start mt-4">
            <div class="col">
                <label for=""> <b>Total de la commande:</b></label>
                <label style="float:right;"> <b> <?= $total_without . " " . 'MAD' ?> </b> </label>
                <br> 
                <label for=""> <b>Frais de livraison :</b></label>
                <label style="float:right;"> <b> <?=15  . " " . 'MAD' ?> </b> </label>
                <br> <br>
                <label style="color:green; font-size:18px;"> <b>Total à payer :</b></label>
                <label style="float:right; color:green; font-size:18px; "> <b> <?=$total_affich  . " " . 'MAD' ?></b> </label>
            </div> 
          </div>

          <div class="row justify-content-start mt-4">
            <div class="col">
                <input  type="submit" value="Payer" name="buy"  class="btn btn-success mt-2">
            </div> 
          </div>

        </div>
      </div>
    </form>
  </section>
                
</body>


<?php } else {

?>
<div class="alert alert-success my-3">
  Votre commande a été confirmée avec succès.
</div>

<?php } ?>
     
  


