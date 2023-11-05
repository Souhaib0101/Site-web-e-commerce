
<?php require_once '../include/nav.php'  ?> <!-- Fonction appelle nav bar --> 

<!-- Backend --> 

<?php  

require_once '../../model/database.php';
// variable des erreurs (placeholder ) // 
$usernameError = 'Username';  
$emailError = 'Email';  
$pswdconfirmError = 'Confirm Password';
// variable value des erreurs (value) // 
$email ='';
$username ='';
$pswd ='';


    if(isset($_POST['register'])) { // condition clique sur register //

       $username = htmlspecialchars($_POST['username']);
        $pswd = htmlspecialchars($_POST['password']);
        $email = htmlspecialchars($_POST['email']);
        

        
      
        // condition Remplissage //
        if(!empty($username) && !empty($pswd) && !empty($email) && !empty($_POST['password-confirm'])) {
          // selectionner et compter les champs dupliqués //
          $Count = $cnx->prepare(query:'SELECT count(username) FROM user where username=? '); 
          $Count->execute([$username]); 
          $countname = $Count->fetchColumn();

          $Count = $cnx->prepare(query:'SELECT count(email) FROM user where email=? '); 
          $Count->execute([$email]); 
          $countemail = $Count->fetchColumn();
          
           // Condition d'arret si il y a plusieurs utilisateurs avec le meme 'username/email' //
         if($countname < 1)  {
            if($countemail < 1) {
             
           
            // Confirmation password / check-btn //
            if($_POST['password-confirm'] === $pswd) {
                if(isset($_POST['check-btn']) ){

                     /* appelle database*/
                     require_once '../../model/database.php';
                     $date = date('Y-m-d H:i:s');
                   
                     $sqlstate = $cnx->prepare(query:'INSERT INTO user VALUES(null,?,?,?,?)'); /* ?,?.. se sont les variables*/
                     $sqlstate->execute([$username,$pswd,$email,$date]);  

                          // redirection //
                         header('Location: ../Both_Navigation/Login.php');

                    
                  }  else {
                    ?>      <div class="alert alert-danger my-3">
                                Vous devez cocher la case 
                            </div>
                    <?php }    
                 
                

                  }  else  {
                  ?>
                          <style>
                          #pswdconfirm-input::placeholder{ 
                            color : red;
                          }
                          </style>
                  <?php
                         $pswdconfirmError = 'You password confirmation is false';  // afficher les messgaes d'erreurs en 'placeholder' //       
                           }         
  
                } else{
                  ?>
                        <style>
                        #email-input::placeholder{    /* changer du coleur de l'input */
                          color : red;
                        }
                        </style>
                  <?php
                        $emailError = 'This e-mail have already an account';  // afficher les messgaes d'erreurs en 'placeholder' //  
                        $email = '';       
                      }       
                 
            }  else{
              ?>
                    <style>

                    #user-input::placeholder{   /* changer du coleur de l'input */
                      color : red;
                      
                    }
                    </style>
              <?php
                  $usernameError = '* This username is already used ! *';  
                  $username = '';      
                  }       
              
        
          
      }    else {
        ?>           <div class="alert alert-danger my-3 " >
                        Tous les champs sont obligatoires!
                     </div>  
        <?php   }
          
    }
 ?>



<!-- Frontend--> 

<section class="" style="  height: calc(100vh - 80px) ; padding-top:30px; ">
<style>
  section{
    background-image:  url(../images/bgnew2.jpg);
    background-size : cover;
    background-position: right;
    

  }
</style>

<form style=" background : #ffffff; width:60%;"  class="container my-5 p-4" method="Post">
      
     
      <div class="row justify-content-center " >
        <div class="col-12 col-md-8 col-lg-8 col-xl-10">
          <div class="row">
            <div class="col text-center">
              <h1 style="color: #black; font-size: 32px; font-weight:bold;"> Registre </h1>
              <p class="text-h3 "> Remplissez le formulaire avec vous informations personnelles. </p>
            </div>
          </div>
          
          <div class="row align-items-center">
            <div class="col mt-4">
              <input type="text" class="form-control" id="user-input"  placeholder="<?= $usernameError ?>" name="username"  value="<?= $username ?>" >
            </div>
          </div>
          <div class="row align-items-center mt-4">
            <div class="col">
              <input type="email" class="form-control" id="email-input" placeholder="<?= $emailError ?>" name="email"  value="<?= $email ?>" >
            </div>
          </div>
          <div class="row align-items-center mt-4">
            <div class="col">
              <input type="password" class="form-control" placeholder="Password" name="password"  value="<?= $pswd ?>" >
            </div>
            <div class="col">
              <input type="password" class="form-control"  id="pswdconfirm-input" placeholder="<?= $pswdconfirmError ?>" name="password-confirm" >
            </div>
          </div>
          <div class="row justify-content-start mt-4">
            <div class="col">
              <div class="form-check">
                <label class="form-check-label">
                  <input type="checkbox" class="form-check-input" name="check-btn">
                  J’ai lu et j’accepte  <a style="background : none; color:#0000FF;" href="#">les termes et conditions</a> <br>
             
                </label>
              </div>

              <input type="submit" class="btn btn-primary mt-4" name="register" value="Registre"> 
             
            </div>
            
          <p class="my-4"> Vous avez déjà un compte ? <a style="background:none;  color:#0000FF;" href="http://localhost/myphp/view/Both_Navigation/Login.php">Login</a>  
          </div>
        </div>
      </div>
    </form>
  </section>

  <!-- Inclusion du footer -->
<?php require_once '../include/Footer.html' ?>



<link rel="stylesheet" href="../Both_Navigation/WebContent.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">