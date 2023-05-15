<?php session_start();
include_once 'function/function.php';
include_once 'function/addSujet.class.php';
$bdd = bdd();


if (isset($_POST['name']) 
AND isset($_POST['categorie'])
AND isset($_POST['prix']) 
AND isset($_POST['entreprise']) 
AND isset($_POST['description'])) {
    
    
    $addSujet = new addSujet(
        $_POST['name'],
        $_POST['categorie'],
        $_POST['prix'],
        $_POST['entreprise'],
        $_POST['description']);
    
   
        $verif = $addSujet->verif();
        if($verif == "ok"){
            if($addSujet->insert()){
                header('Location: index.php?sujet='.$_POST['name']);
            }
        }
        else {/*Si on a une erreur*/
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
</head>
<body>
    <header>

        <div class="topnav">
            <a class="active" href="index.php">Home</a>

        </div>

    </header>
 <h1>Ajouter un service</h1>
    
    <div id="Cforum">
        <?php 
            $nom = $bdd->prepare('SELECT * FROM membre_pro WHERE id = :id
            UNION SELECT * FROM membre_client WHERE id = :id');
            $nom->execute(array('id' => $_SESSION['id']));
            $user = $nom->fetch();
            echo 'Bienvenue : ' . $user['nom'].' '.$user['prenom'].'  :) - <a href="deconnexion.php">Deconnexion</a> ';
        ?>                
        <form method="post" action="addSujet.php?categorie=<?php echo $_GET['categorie']; ?>">
            <p>
                <br><input type="text" name="name" placeholder="Nom du service..." required/><br>
                <textarea name="description" placeholder="description..."></textarea><br>
                
                <select name="categorie" id="liste">
                    <option value="garage">garage</option>
                    <option value="coiffeur">coiffeur</option>
                    <option value="esthetisienne">esthetisienne</option>
                    <option value="dentiste">dentiste</option>
                    <option value="reparation informatique">reparation informatique</option>
                </select><br>
    
                <input type="number" name="prix" placeholder="prix..." required/><br>
                <input type="text" name="entreprise" placeholder="entreprise..." required/><br>
                <input type="submit" value="Ajouter le service" />
                
                <table>
                    <thead>
                        <tr>
                            <th>
                                horaire
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr><!--ligne -->
                            <td>1</td><!--colone -->
                            <td>2</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>4</td>
                        </tr>
                    </tbody>
                </table>
                <?php 
                if(isset($erreur)){
                    echo $erreur;
                }
                ?>
            </p>
        </form>
    </div>
</body>
</html>
