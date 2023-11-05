
<?php  require_once '../include/navadmin.php' ?> 
       
<section class="mt-4">
<div class="container py-2">

<?php

    $admin_name = $_SESSION['admin']['admin_name'];
    if(isset($_SESSION['admin'])){
    ?> 
        <h3 style="color:green; font-family:poppins; font-weight:bold; font-size:32px;" class="mt-5 text-center"> 
            <?php  echo '<span style="color:black; "> Bonjour admin </span>' . ' ' . $admin_name  ; ?> 
        </h3>

        <div class="container py-5">
            <h4 style="font-size:24px; font-weight:bold; color:green; text-decoration:underline;"> Manuel d'utilisation</h4>
           
            <p> Ce Type de navigation est autorisé seulement pour les administrateurs, chaque modification a un effecte sur le site principal, Pour les options:
                <h4 style="font-size:24px; font-weight:bold; color:black; text-decoration:underline;">Ajouter un produit :</h4><p> Ajouter un nouveau produit avec ses informations et détails,  le nom, l'image du produit, prix etc. 
                <h4 style="font-size:24px; font-weight:bold; color:black; text-decoration:underline;"> Liste des produits : </h4><p> cette page contient une liste des informations sur les produits disponibles, dans cette liste vous pouvez supprimer un produit <br> ou modifier les informations d'un produit. 
                <h4 style="font-size:24px; font-weight:bold; color:black; text-decoration:underline;"> Liste des commandes :</h4> <p>cette page offre un tableau des informations sur les commandes effectués et sur les clients qui ont acheté des produits. 
                <h4 style="font-size:24px; font-weight:bold; color:black; text-decoration:underline;"> Détails des commandes :</h4><p> pour plus de détails et d'informations sur les commandes effectués il faut consulter cette page, mais avant de ça il faut indiquer un produit, <br> si non ça va afficher une erreur. 

                <h4 style="font-size:24px; font-weight:bold; color:black; text-decoration:underline;">Déconnexion: </h4> <p>L'option déconnexion est une option simple qui vous permez de déconnecter de votre compte.
            </p>

            <div class="alert alert-warning my-5"> <b> ATTENTION !</b> chaque modification provoque une autre modification sur le site principal.
                en tout cas contacter l'administrateur chef si vous ne savez pas comment utiliser ses options
            </div>
        </div>

        <style>
            h2{
                color:#49111c ;
            }
            p{
                font-size:18px;
            }
        </style>

    <?php

        

    }
?>
        
</div>
</section>

<style>
    section{
        height: calc(100vh) ;
       
        background: url();
        background-size:cover;
    }
</style>
