    <?php 
        $opt2 = 'active';
        require_once '../include/navadmin.php'  
    ?> 

    <?php
    // extract(&array:$_POST);  fonction meme operation que celle la en bas //

    if (isset($_POST['add'])) {
        $product_name = $_POST['product_name'];
        $price = $_POST['price'];
        $discount = $_POST['discount'];
        $description = $_POST['description'];
        $date = date('Y-m-d H:i:s');
        $filename = '';

         if (!empty($_FILES['picture']['name'])) {   // files[--][--] , on appelle un fichier avec son nom comme id//
            $filename = $_FILES['picture']['name'];
            /* $filename = uniqid() . $picture;  */  // uniqid() fonction pour donner un id unique a chaque photo //
            move_uploaded_file($_FILES['picture']['tmp_name'], '../images/Products-Pics/products_pictures/' . $filename);
                        // move_uploaded_file fonction transfere le fichier a une autre destination //
       } 
 
        if (!empty($product_name) && !empty($price) && !empty($description)) {

            require_once '../../model/database.php';
            $sqlState = $cnx->prepare('INSERT INTO products VALUES (null,?,?,?,?,?,?)');
            $inserted = $sqlState->execute([$product_name, $price, $description, $discount, $date , $filename ]);  //ordre DB//

            

            if ($inserted) {
                header('location: ProductsList.php');  // condition verifie l'operation en haut //
            } else {
                    ?>
                        <div class="alert alert-danger" role="alert">
                             L’opération n’a pas réussi !
                        </div>
                    <?php
                   }
        } else {
            
                ?>  
                    <div class="alert alert-danger" role="alert">
                    Assurez-vous de remplir tous les champs
                    </div>
                <?php   
                }
 
            }

    ?>

<div class="container py-2">
    <h3 class="mt-5" style="font-size:24px; font-weight:bold; color:black; text-decoration:underline;">AJOUTER UN PRODUIT </h3>
<form method="post" class="mt-4" enctype="multipart/form-data">
        <label class="form-label">Nom du produit</label>
        <input type="text" class="form-control" name="product_name">

        <label class="form-label">Prix</label>
        <input type="number" class="form-control" step="0.1" name="price" min="0">

        <label class="form-label">Remise</label>
        <input type="number" value="0" class="form-control" name="discount" min="0" max="90">

        <label class="form-label">Description</label>
        <textarea class="form-control" name="description"></textarea>

        <label class="form-label">Image du produit</label>
        <input type="file" class="form-control" name="picture"  accept="image/*">  <!-- accept juste format image -->

        <input type="submit" value="Confirmer" class="btn btn-success my-3" name="add">
    
</form>
</div>


