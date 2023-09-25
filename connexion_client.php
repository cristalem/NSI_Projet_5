<?php session_start();
include_once 'function/function.php';
include_once 'function/connexion_client.class.php';
include_once 'function/mise_en_page.php';
$bdd = bdd();
if(isset($_POST['email']) AND isset($_POST['mdp'])){//si on a un email et un mot de passe 
    
    $connexion = new connexion_client($_POST['email'],$_POST['mdp']);
    $verif = $connexion->verif();//verifie si c'est bon
    if($verif =="ok"){
      if($connexion->session()){
          header('Location: index.php');//connect et renvoie sur page index
      }
    }
    else {
        $erreur = $verif; //sinon affiche l'erreur
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

 <h1>Connexion client</h1>
    
    <div id="Cforum">
          
       
            <form method="post" action="connexion_client.php">
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
