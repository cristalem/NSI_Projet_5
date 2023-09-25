<?php
include_once 'function/function.php';
include_once 'function/inscription_ent.class.php';
include_once 'function/mise_en_page.php';
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

<body>
    
    <header>

        <div class="topnav">
            <a class="active" href="index.php">Home</a>
            <a href="connexion.php">Se connecter</a>
        </div>

    </header>


 <h1>Inscription entreprise</h1>
    
 <div id="Cforum">

        <form method="post" action="inscription_ent.php">
            <p>
                <label for="entreprise">entreprise</label><br>
                <input name="entreprise" class="w3-input" type="text" placeholder="entreprise..." value="<?php echo isset($_POST['entreprise']) ? htmlspecialchars($_POST['entreprise']) : ''; ?>" required /><br>

                <label for="ville">ville</label><br>
                <input name="ville" class="w3-input" type="text" placeholder="ville..." value="<?php echo isset($_POST['ville']) ? htmlspecialchars($_POST['ville']) : ''; ?>" required /><br>

                <label for="adresse">adresse</label><br>
                <input name="adresse" class="w3-input" type="text" placeholder="adresse..." value="<?php echo isset($_POST['adresse']) ? htmlspecialchars($_POST['adresse']) : ''; ?>" required /><br>

                <label for="code_postal">code postal</label><br>
                <input name="code_postal" class="w3-input" type="text" placeholder="code postal..." value="<?php echo isset($_POST['code_postal']) ? htmlspecialchars($_POST['code_postal']) : ''; ?>" required /><br>

                <label for="tel">numero de telephone</label><br>
                <input name="tel" class="w3-input" type="text" placeholder="numero de telephone..." value="<?php echo isset($_POST['tel']) ? htmlspecialchars($_POST['tel']) : ''; ?>" required /><br>

                <label for="categorie">categorie</label><br>
                <select name="categorie" class="w3-select" id="categorie">
                    <option value="garage">garage</option>
                    <option value="coiffeur">coiffeur</option>
                    <option value="estheticienne">estheticienne</option>
                    <option value="dentiste">dentiste</option>
                    <option value="reparation informatique">reparation informatique</option>
                </select><br><br>


                <input type="submit" class="w3-button" value="S'inscrire!" />
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
