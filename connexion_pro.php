<?php session_start();
include_once 'function/function.php';
include_once 'function/connexion_pro.class.php';
include_once 'function/mise_en_page.php';

$bdd = bdd();
if(isset($_POST['email']) AND isset($_POST['mdp'])){
    
    $connexion = new connexion_pro($_POST['email'],$_POST['mdp']);
    $verif = $connexion->verif();
    if($verif =="ok"){
      if($connexion->session()){
          header('Location: index.php');
      }
    }
    else {
        $erreur = $verif; 
    } 
}


?>
<!DOCTYPE html>

<body>
    
    <header>

        <div class="topnav">
            <a class="active" href="index.php">Home</a>
            <a href="inscription.php">S'inscrire</a>
        </div>

    </header>

 <h1>Connexion professionnel</h1>
    
    <div id="Cforum">
          
       
            <form method="post" action="connexion_pro.php">
                <input name="email" class="w3-input" type="text" placeholder="email..." required /><br>
                <input name="mdp" class="w3-input" type="password" placeholder="Mot de passe..." required /><br>
                <input type="submit" class="w3-button" value="Connexion !" />
            </form>
        
        <?php 
            
            // Vérification des erreurs
            if(isset($erreur)){
                echo '<div class="error">' . $erreur . '</div>';
            }
            ?>
        
    </div>
</body>
</html>
