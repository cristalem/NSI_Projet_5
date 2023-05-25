<?php
include_once 'function/function.php';
include_once 'function/inscription_client.class.php';
include_once 'function/mise_en_page.php';
$bdd = bdd();


if(
    isset($_POST['nom']) 
AND isset($_POST['prenom']) 
AND isset($_POST['email']) 
AND isset($_POST['mdp'])  
AND isset($_POST['mdp2'])){
  
    $inscription = new inscription_client(
        $_POST['nom'],
        $_POST['prenom'],
        $_POST['email'],
        $_POST['mdp'],
        $_POST['mdp2']);

    $verif = $inscription->verif();
    if($verif == "ok"){/*Tout est bon*/
     if($inscription->enregistrement()){
            if($inscription->session()){ /*Tout est mis en session*/
                header('Location: index.php');
            }
        }
        else{ /*Erreur lors de l'enregistrement*/
            echo 'Une erreur est survenue';
        }   
    } else {
       $erreur = $verif;
    }
    
}
?>
<!DOCTYPE html>

<body>
    
    <header>

        <div class="topnav">
            <a class="active" href="index.php">Home</a>
            <a href="connexion.php">Se connecter</a>
        </div>

    </header>


 <h1>Inscription client</h1>
    
 <div id="Cforum">

        <form method="post" class="w3-panel" action="inscription_client.php">
            <p>
                <label for="nom">nom</label><br>
                <input name="nom" class="w3-input" type="text" value="<?php echo isset($_POST['nom']) ? htmlspecialchars($_POST['nom']) : ''; ?>" required /><br>

                <label for="prenom">Prénom</label><br>
                <input name="prenom" class="w3-input" type="text" value="<?php echo isset($_POST['prenom']) ? htmlspecialchars($_POST['prenom']) : ''; ?>" required /><br>

                <label for="email">Email</label><br>
                <input name="email" class="w3-input" type="text" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" required /><br>

                <label for="mdp">Mot de passe</label><br>
                <input name="mdp" class="w3-input" type="password" required /><br>

                <label for="mdp2">confirmation du mot de passe</label><br>
                <input name="mdp2" class="w3-input" type="password" required /><br>


                <input type="submit" class="w3-button" value="S'inscrire" />
            </p>
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
