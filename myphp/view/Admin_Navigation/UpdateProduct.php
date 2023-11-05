
<?php 
        $opt3 = 'active';
        require_once '../include/navadmin.php'  
?> 
        

    <?php
    $id = $_GET['id'];  // method get just (id) //
    require_once '../../model/database.php';
    $sqlState = $cnx->prepare('SELECT * from products WHERE id=?');  // donner a l'id leur valeur epuis DB //
    $sqlState->execute([$id]);
    $product = $sqlState->fetch(PDO::FETCH_OBJ);   // affecter a un variable le pouvoir de lire toutes les lignes de la table products //

    if (isset($_POST['Update'])) {    // condition clique sur button update , affecter a chaque variable les nouvelles valeurs //
        $product_name = $_POST['product_name'];
        $price = $_POST['price'];
        $discount = $_POST['discount'];
        $description = $_POST['description'];
        $filename = $_FILES['picture']['name'];
       

        if (!empty($_FILES['picture']['name'])) {

            $filename = $_FILES['picture']['name'];
            move_uploaded_file($_FILES['picture']['tmp_name'], '../images/Products-Pics/products_pictures/' . $filename);
        }
    

        if (!empty($product_name) && !empty($price) && !empty($description)) {
            if (!empty($filename)) { 

                // lire la requete qui permet la modification en sql //
                $query = "UPDATE products SET product_name=? ,price=? , description=? ,discount=? , filename=? WHERE id = ? "; 
                $sqlState = $cnx->prepare($query);
                // les changements sont affecter comme nouvelles valeurs //
                $updated = $sqlState->execute([$product_name, $price, $description, $discount,$filename , $id]);
           
            } else {

                $query = "UPDATE products SET product_name=? ,price=? , description=? ,discount=?  WHERE id = ? "; 
                $sqlState = $cnx->prepare($query);
                $updated = $sqlState->execute([$product_name, $price, $description, $discount , $id]);
                // au cas ou l'image file reste vide les changements sur la photo n'est pas applique //

                }
                
          
            if ($updated) {  // si l'operation est complet.. //
                header('location: ProductsList.php');
            } else {

                ?>
                <div class="alert alert-danger" role="alert">
                 Opération non terminée, veuillez réessayer !
                </div>
                <?php
            }
        } else {
            ?>
            <div class="alert alert-danger" role="alert">
              Assurez-vous de remplir tous les champs.
            </div>
            <?php
        }

    }
    ?>
    <div class="container py-5" >
    <h4 class="mt-4" style="font-size:24px; font-weight:bold; color:black; text-decoration:underline;"> MODIFICATION</h4>
    <form method="post" class="mt-4" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $product->id ?>">  <!-- cacher l'input id  -->
        <label class="form-label">Nom du produit</label>
        <input type="text" class="form-control" name="product_name" value="<?= $product->product_name ?>">  <!-- garder les anciennes valeurs  -->

        <label class="form-label">Prix</label>
        <input type="number" class="form-control" step="0.1" name="price" min="0" value="<?= $product->price ?>">

        <label class="form-label">Remise</label>
        <input type="number"  class="form-control" name="discount" min="0" max="90"
               value="<?= $product->discount ?>">

        <label class="form-label">Description</label>
        <textarea class="form-control" name="description"> <?= $product->description ?> </textarea>

        <label class="form-label">Image du produit</label>
        <input type="file" class="form-control" name="picture" accept="image/*">  <!-- accept juste format image -->
        <div style="background:#edf2f4;  width:180px; text-align:center;" class="my-4" >
        <span style="font-weight:bold;"> L'image actuelle</span>
        <img class="img img-fluid container" width="150px" height="150px" src="../images/Products-Pics/products_pictures/<?= $product->filename ?>" alt="">    <br>    
        </div>


        <input type="submit" value="Modifier" class="btn btn-primary my-2" name="Update">
    </form>
</div>
