
<?php  require_once '../include/navadmin.php'; 
  require_once '../../model/database.php';

$idCommand = $_GET['id'];
$sqlState = $cnx->prepare('SELECT * FROM command WHERE id = ? ORDER BY date_command DESC');
$sqlState->execute([$idCommand]);
$commandDetails = $sqlState->fetch(PDO::FETCH_OBJ);

if (!isset($_GET['id'])) {
?>
    <div class="alert alert-danger my-3">
    Il n’y a pas d’ID choisi! Vous devriez revenir en arrière et choisir un ID.
    </div>
<?php
} else {
?>

    <head>
        <title> <?= $commandDetails->id ?> </title>
    </head>

    <div class="container py-5">
        <h3 class="mt-4 mb-5"style="font-size:24px; font-weight:bold; color:green; text-decoration:underline;">LISTE DES COMMANDES</h3>
        <table style="text-align:center;" class="table table-striped table-hover ">
            <thead class="table-success">
                <tr>
                    <th>ID</th>
                    <th>ID_UTILISATEUR</th>
                    <th>NOM_UTILISATEUR</th>
                    <th>MONTANT TOTAL</th>
                    <th>DATE DE COMMANDE</th>
                    <th>SITUATION</th>
                </tr>
            </thead>
            <tbody>
                <?php
                 require_once '../../model/database.php';
                $Frais_livraison = 15;

                ?>
                <tr>
                    <td><?= $commandDetails->id ?></td>
                    <td><?= $commandDetails->id_user ?></td>
                    <td><?= $commandDetails->username ?></td>
                    <td><?= $commandDetails->total +  $Frais_livraison ?> MAD </td>
                    <td><?= $commandDetails->date_command ?></td>
                    <td> Validé  <i class="fa-solid fa-circle-check" style="color: #2ee05b;"></i></td>
                </tr>
            </tbody>
        </table>
        </div>

        <div class="container py-2">
        <!--  2eme table of details -->
        <h3 class="my-5"style="font-size:24px; font-weight:bold; color:#49111c; text-decoration:underline;">DETAILS DES COMMANDES</h3>
        <table style="text-align:center;" class="table table-striped table-hover my-3">
            <thead class="table-primary" >
                <tr>
                    <th>ID</th>
                    <th>ID_COMMANDE</th>
                    <th>ID_PRODUIT</th>
                    <th>NOM_PRODUIT</th>
                    <th> PRIX UNITAIRE </th>
                    <th>QUANTITE</th>
                    <th>PRIX TOTAL</th>
                    <th> OPERATIONS </th>
                </tr>
            </thead>


            <tbody > 
                <?php 
                $sqldetail = $cnx->prepare("SELECT * FROM product_command WHERE id_command=?");
                $sqldetail->execute([$idCommand]);
                $details = $sqldetail->fetchAll(PDO::FETCH_OBJ);
              

                foreach ($details as $detail) {
                ?>
                <tr>
                    <td><?= $detail->id ?></td>
                    <td><?= $detail->id_command ?></td>
                    <td><?= $detail->id_product ?></td> 
                    <td><?= $detail->product_name ?></td>
                    <td><?= $detail->price ?> MAD</td>
                    <td><?= $detail->quantity ?>KG</td>
                    <td><?= $detail->price_total ?> MAD </td>
                    <td> <a class="btn btn-warning" href="http://localhost/myphp/view/Admin_Navigation/Commandlist.php">Liste des commandes</a> </td>
                </tr>

                <?php
                     } }
                ?>
            </tbody>

        </table>
     
            


    </div>

