<?php
include_once 'function/function.php';
include_once 'function/inscription_pro.class.php';
$bdd = bdd();


if(isset($_POST['email']) 
    AND isset($_POST['mdp'])  
    AND isset($_POST['mdp2'])
    AND isset($_POST['nom'])
    AND isset($_POST['prenom'])){
    
    $inscription = new inscription_pro($_POST['email'],
        $_POST['mdp'],
        $_POST['mdp2'],
        $_POST['nom'],
        $_POST['prenom']);

    $verif = $inscription->verif();
    if($verif == "ok"){/*Tout est bon*/
     if($inscription->enregistrement()){
            if($inscription->session()){ /*Tout est mis en session*/
                header('Location: inscription_ent.php');
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
<head>
    <meta charset='utf-8' />
    <title>forum</title>
    <link rel="stylesheet" type="text/css" href="css/general.css" />
    <link rel="shortcut icon" href="images/favicon.ico" />
    <link href='http://fonts.googleapis.com/css?family=Karla' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="css/error.css" />
</head>
<body>
    
    <header>

        <div class="topnav">
            <a class="active" href="index.php">Home</a>
            <a href="connexion.php">Se connecter</a>
        </div>

    </header>


 <h1>Inscription pro</h1>
    
 <div id="Cforum">
    <?php if(isset($erreur)): ?>
        <div class="error"><?php echo $erreur; ?></div>
    <?php endif; ?>

        
        <form method="post" action="inscription_pro.php">
            <p>
                <input name="nom" type="text" placeholder="nom..." required /><br>
                <input name="prenom" type="text" placeholder="prenom..." required /><br>
                <input name="email" type="text" placeholder="Adresse email..." required /><br>
                <input name="mdp" type="password" placeholder="Mot de passe..." required /><br>
                <input name="mdp2" type="password" placeholder="Confirmation..." required /><br>
                <input type="submit" value="S'inscrire!" />
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
