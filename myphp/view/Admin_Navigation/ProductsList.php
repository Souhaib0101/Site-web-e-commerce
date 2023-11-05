<?php  require_once '../include/navadmin.php' ?> 
<link rel="stylesheet" href="styleadmin.css">


<div class="container py-5">
    <h3 class="mt-4" style="font-size:24px; font-weight:bold; color:black; text-decoration:underline;"> LISTE DES PRODUITS </h3>
    <a href="AjouterProduit.php" class="btn btn-primary my-4">Ajouter produit</a>
    <table class="table table-hover  my-4" style="text-align:center;">
        <thead class="table-primary">
            <tr>
                <th  class="p-3">ID</th>
                <th  class="p-3">NOM DU PRODUIT </th>
                <th  class="p-3">PRIX</th>
                <th  class="p-3" style="visibility:hidden; display:none;">DESCRIPTION</th>
                <th  class="p-3">REMISE</th>
                <th  class="p-3">DATE DE CREATION </th>
                <th  class="p-3">IMAGE</th>
                <th  class="p-3">OPERATIONS</th> 
            </tr>
        </thead>
        <tbody>
        <?php
            require_once '../../model/database.php';

        $products = $cnx->query("SELECT * FROM products")->fetchAll(PDO::FETCH_OBJ);  // exécute une requête SQL pour sélectionner toutes les lignes de la table "products" //
        foreach ($products as $product){  // boucle permet de lire tous les lignes de la table products//
            $price = $product->price;
            $discount = $product->discount;
            $priceFinal = $price - (($price*$discount)/100);
            ?>
            <tr>
                <td ><?= $product->id ?></td>
                <td><?= $product->product_name ?></td>
                <td><?= $price ?> MAD </td>
                <td style="visibility:hidden; display:none;"><?= $product->description ?></td>
                <td><?= $discount ?> %</td>
                <td><?= $product->Date ?></td>
                <td><img class="" width="50px" height="55px" src="../images/Products-Pics/products_pictures/<?= $product->filename ?>" alt="">   </td>

                <td>
                    <a class="btn btn-success" href="UpdateProduct.php?id=<?php echo $product->id ?>">Modifier</a>  <!-- Access into the file with the method get (id) -->
                    <!-- onclick fonction de confirmation , oui , non -->
                    <a class="btn btn-danger" href="DeleteProduct.php?id=<?php echo $product->id ?>" onclick="return confirm('Êtes-vous sûr de supprimer <?php echo $product->product_name?> ?')">Supprimer</a>
                </td>
               
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
</div>

