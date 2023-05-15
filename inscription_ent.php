<?php
include_once 'function/function.php';
include_once 'function/inscription_ent.class.php';
$bdd = bdd();


if(isset($_POST['entreprise'])
    AND isset($_POST['ville']) 
    AND isset($_POST['categorie'])  
    AND isset($_POST['adresse'])
    AND isset($_POST['code_postal'])
    AND isset($_POST['tel'])){
  
    $inscription = new inscription(
        $_POST['entreprise'],
        $_POST['ville'],
        $_POST['categorie'],
        $_POST['adresse'],
        $_POST['code_postal'],
        $_POST['tel']);

    $verif = $inscription->verif();
    if($verif == "ok"){/*Tout est bon*/
     if($inscription->enregistrement()){ /*Tout est mis en session*/
                header('Location: index.php');
            
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


 <h1>Inscription entreprise</h1>
    
 <div id="Cforum">
    <?php if(isset($erreur)): ?>
        <div class="error"><?php echo $erreur; ?></div>
    <?php endif; ?>

        <form method="post" action="inscription_ent.php">
            <p>
                <label for="entreprise">entreprise</label><br>
                <input name="entreprise" type="text" placeholder="entreprise..." required /><br>

                <label for="ville">ville</label><br>
                <input name="ville" type="text" placeholder="ville..." required /><br>

                <label for="adresse">adresse</label><br>
                <input name="adresse" type="text" placeholder="adresse..." required /><br>

                <label for="code_postal">code postal</label><br>
                <input name="code_postal" type="text" placeholder="code postal..." required /><br>

                <label for="tel">numero de telephone</label><br>
                <input name="tel" type="text" placeholder="numero de telephone..." required /><br>

                <label for="categorie">categorie</label><br>
                <select name="categorie" id="categorie">
                    <option value="garage">garage</option>
                    <option value="coiffeur">coiffeur</option>
                    <option value="esthetisienne">esthetisienne</option>
                    <option value="dentiste">dentiste</option>
                    <option value="reparation informatique">reparation informatique</option>
                </select>


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
