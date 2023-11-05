
<?php require_once '../include/nav.php'  ?> <!-- Fonction appelle nav bar --> 

<!-- backend--> 
<?php 
 
$nametext ='Username';
$pswdtext ='Password';

    if (isset($_POST['Login'])){  // Condition clique Login //
        $username = htmlspecialchars($_POST['username']);
        $pswd = htmlspecialchars($_POST['epassword']);
        $check_who = $_POST['check_who'];
        
        if(!empty($username) && !empty($pswd)){
            if($check_who == 'user'){ 
          
            require_once '../../model/database.php';
            $sqlState = $cnx->prepare(query:'SELECT * FROM user WHERE username=? And password=? ; ');
            $sqlState->execute([$username, $pswd]);  // importer les donnes de connexion du DB //

                if ($sqlState->rowCount()>=1){
                    session_start();
                    $_SESSION['user'] = $sqlState->fetch();  // commencer session comme user //

                    header('location: ../User_Navigation/Products.php');
                         

                }  else {
                            // Username not found, display an error message //
                            ?>     
                                <div class="alert alert-danger my-3">
                                  Nom d’utilisateur ou mot de passe incorrect. Veuillez réessayer.
                                </div>
                            <?php
                        } 

                        // here //
            } else{
                if($check_who == 'admin'){
                    require_once '../../model/database.php';

                    $sqlState = $cnx->prepare(query:'SELECT * FROM admin WHERE admin_code=? And password=? ; ');
                    $sqlState->execute([$username, $pswd]);  // importer les donnes de connexion du DB //

                    if ($sqlState->rowCount()>=1){
                        session_start();
                        $_SESSION['admin'] = $sqlState->fetch();  // commencer session comme user //

                        header('location: ../Admin_Navigation/Admin.php'); 

                    } else{
                        ?>     
                                <div class="alert alert-danger my-3">
                                        admin code or Password incorrect. Veuillez réessayer.
                                </div>
                        <?php
                         }  
                 } }
             
                 
        } else{

          ?>    <div class="alert alert-danger my-3">
                    Nom d’utilisateur et mot de passe requis ! 
                </div>

          <?php
    }                                                      
    }

?>


<!-- Frontend--> 
<section  class="" style=" height: calc(100vh ) ">
<style>
  section{
    background-image:  url(../images/bgnew2.jpg);
    background-size : cover;
    background-position: right;
    
  }
</style>
<div class="container p-5">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="mb-3">
                <h2  style="color: black; font-size: 31px; font-weight:bold; letter-spacing:0.2rem; text-align:center;" class="mt-5">Bienvenue !</h2>
            </div>
            <form  style=" background : #ffffff;" class="shadow p-5" method="Post">   
            <h2 style="color: black; font-size:23px; font-weight:bold;" class="mb-4"> Login</h2> 
            <!-- variable en placeholder varie avec les cas user/admin -->              
                <div class="mb-4">
                    <input type="text" class="form-control" name="username" id="username" placeholder="<?= $nametext ?>">
                </div>

                <div class="mb-4">
                    <input type="password" class="form-control" name="epassword" id="Password" placeholder="<?=  $pswdtext ?>">
                </div>

                <div class="mb-4">
                    <select class="form-select" name="check_who" id="">
                        <option name="user" value="user">utilisateur</option>
                        <option name="admin" value="admin">administrateur</option>
                    </select>
                </div>

            <!--     <label class="mb-3">
                    <input type="checkbox" name="RememberMe"> Remember Me
                </label> -->

                <!-- <a href="#" class="float-end text-decoration-none">Reset Password</a> -->
              
                <div class="mb-3">
                 <input type="submit" class="btn btn-success col-3" name="Login" value="Login">
                </div>

                <hr>

                <p class="text-center mb-0 ">Si vous n’avez pas de compte <a style="background:none; color:#0000FF;" href="http://localhost/myphp/view/User_Navigation/SignUp.php">Inscrivez-vous</a></p>
                
            </form>
        </div>
    </div>
</div>
    
</section>


  <!-- Inclusion du footer -->
  <?php require_once '../include/Footer.html' ?>
 


<link rel="stylesheet" href="WebContent.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">