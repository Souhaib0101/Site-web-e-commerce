<?php  require_once '../include/navadmin.php' ?> 

<div class="container py-5">
    <h3 class="mt-4 mb-5" style="font-size:24px; font-weight:bold; color:black; text-decoration:underline;"> Liste des commandes </h3>
   <!--  <a href="AjouterProduit.php" class="btn btn-primary my-4"> Command List </a> -->
    <table class="table table-hover" style="text-align:center;">
        <thead class="table-success">
            <tr>
                <th>ID</th>
                <th>ID_UTILISATEUR</th>
                <th>NOM_UTILISATEUR</th>
                <th>MONTANT TOTAL</th>
                <th>DATE_COMMANDE</th>
                <th>OPERATIONS</th> 
            </tr>
        </thead>
        <tbody>
        <?php
            require_once '../../model/database.php';

        $commands = $cnx->query("SELECT * FROM command ORDER BY date_command desc ")->fetchAll(PDO::FETCH_OBJ);
        $Frais_livraison = 15;  
        foreach ($commands as $command){ 
            ?>
            <tr>
                <td><?= $command->id ?></td>
                <td><?= $command->id_user?></td>
                <td><?= $command->username ?></td>
                <td><?= $command->total + $Frais_livraison ?> MAD </td>
                <td><?= $command->date_command ?></td>
                <!-- use id command -> access details -->
                <td> <a class="btn btn-primary" href="http://localhost/myphp/view/Admin_Navigation/Commanddetails.php?id=<?php echo $command->id?>"> Détails</a></td>   
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
</div>
