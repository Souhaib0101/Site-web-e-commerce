<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

<?php 
require_once '../include/nav.php'  
?> 


<?php


if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array(); // Initialize the cart as an empty array
}

if (isset($_POST['add_cart'])) {
    $id = $_POST['product_id'];
    $qte = $_POST['quantity'];


    if ($_SESSION['user']) {
        require_once '../../model/database.php';

        $sqlState = $cnx->prepare('SELECT * FROM products WHERE id = ?');
        $sqlState->execute([$id]);

        $cart = $sqlState->fetch(PDO::FETCH_OBJ);

        if ($cart) {
            $price = $cart->price;
            $FinalPrice = $price * $qte;

            // each item => its functionality
            $_SESSION['cart'][$id] = array(
                'id' => $cart->id,
                'product_name' => $cart->product_name,
                'filename' => $cart->filename,
                'price' => $price,
                'quantity' => $qte,
                'final_price' => $FinalPrice
            );
        } else {
            echo "Product not found in the database.";
        }
    } else {
        header('location: ../Both_Navigation/Login.php'); // not connected yet
        exit;
    }
}
?>

<div class="container py-5">
    <h3 class="mt-4"style="font-size:27px; font-weight:bold; color:Green; text-decoration:underline;">Mon Panier</h3>
    <a href="Products.php" class="btn btn-primary my-4">Ajouter au panier</a>
    <table class="table table-striped table-hover text-center mt-5">
        <thead>
            <tr>
               
                <th>Nom du produit</th>
                <th>Image du produit</th>
                <th>Prix unitaire</th>
                <th>Quantité</th>
                <th>Prix total</th>
                <th>Opérations</th>


            </tr>
        </thead>
        <tbody>

            <?php
            // Display the products in the cart
            $total = 0;
            foreach ($_SESSION['cart'] as $cart_item_key => $cart_item) {

                $priceNew = $cart_item['final_price'];
                $qty = $cart_item['quantity'];
                $id = $cart_item['id'];
                

                if(isset($_POST['update']) && $_POST['id_cart'] == $id){
                    
                    $qty = $_POST['quantity'];
                   $priceNew = $cart_item['final_price'];
                   $priceOld = $cart_item['price'];
                   $priceNew = $priceOld * $qty;
                 
                   $_SESSION['cart'][$cart_item_key]['quantity'] = $qty;
                   $_SESSION['cart'][$cart_item_key]['final_price'] = $priceNew;
                }

                ?>

                <tr>
                   
                    <td><?= $cart_item['product_name'] ?? '' ?></td>
                    <td><img class="" width="50px" height="55px" src="../images/Products-Pics/products_pictures/<?= $cart_item['filename'] ?? '' ?>"></td>
                    <td><?= $cart_item['price'] ?? '' ?> MAD</td>

                    <td>
                      
                        <form method="Post" class="d-flex ">
                        <input type="hidden" name="id_cart" value="<?= $cart_item['id'] ?? '' ?>">
                        <input type="number" value="<?= $qty  ?>" class="quantity form-control " name="quantity" min="1" max="100">
                        <button type="submit" name="update" class="btn btn-sm btn-success" > Modifier </button>
                        </form>
                    </td>

                    <td><?= $priceNew ?? '' ?> MAD</td>
                    <td> <a class="btn btn-danger " href="cart.php?id=<?= $cart_item['id'] ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer <?= $cart_item['product_name'] ?> from the cart?')">Supprimer</a> </td>
                    
                    <?php $total += $priceNew;    }   ?>
                    
                </tr>

           

            <tr>
                <td colspan='2' > </td>
                <th > Total : </th>
                <th > <?= $total ?> MAD</th>
                <td></td>

                <?php
                    if ($total > 0) {  
                ?>
                
                <td> 
                    <form method="Post" action="payment.php">
                        <button type="submit" class="btn btn-primary" name="validate" > Valider </button>
                        <a class="btn btn-warning" href="cart.php?delete_all=1" onclick="return confirm('Êtes-vous sûr de vouloir supprimer tous les produits du panier?')">Annuler la commande</a>       
                    </form>
                </td>
            </tr>
 
            <?php }

            if (isset($_GET['id']) && isset($_SESSION['cart'][$_GET['id']])) { // 1- verifie , le passage id dans URL , 2- verifie si il se trouve dans le panier//
                unset($_SESSION['cart'][$_GET['id']]); // supprimer a l'aide de L'id //
                echo '<script>window.location.reload();</script>';
                exit;
            }

            if (isset($_GET['delete_all'])) {               
                unset($_SESSION['cart']);  
          
            }

            ?>
        </tbody>
    </table>
</div>



<link rel="stylesheet" href="../Both_Navigation/WebContent.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">