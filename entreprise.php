<?php session_start();
include_once 'function/function.php';
include_once 'function/entreprise.class.php';
$bdd = bdd();

if(!isset($_SESSION['id']) AND !isset($_SESSION['pseudo'])){

    header('Location: inscription.php');}


$allent = $bdd->query('SELECT * FROM entreprise ORDER BY id ASC'); 
if(isset($_GET['search']) AND !empty($_GET['search'])){ 
    $recherche = htmlspecialchars($_GET['search']); 
    $allent = $bdd->query('SELECT * FROM entreprise WHERE entreprise LIKE "%'.$recherche.'%" ORDER BY id ASC'); 
}

?>

<!DOCTYPE html>
<head>
    <meta charset='utf-8' />
    <title>forum</title>
    <link href='http://fonts.googleapis.com/css?family=Karla' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="css/general.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-0e1dJTGCynxq5ury+5cWTlZ5n9p+aK5oW/72+5IgXYO1l3qQ8l3aVcNpLyLaSzN/" crossorigin="anonymous">
    <link rel="shortcut icon" href="images/favicon.ico" />
    <link rel="stylesheet" href="https://fontawesome.com/icons/magnifying-glass?f=classic&s=solid">
</head>
<body>
    <header>
    
        <div class="topnav">
            <a class="active" href="index.php">Home</a>
            
        </div>

    </header>
    
    <div id="Cforum">
        <?php 
            $nom = $bdd->prepare('SELECT * FROM membre_pro WHERE id = :id
            UNION SELECT * FROM membre_client WHERE id = :id');
            $nom->execute(array('id' => $_SESSION['id']));
            $user = $nom->fetch();
            echo 'Bienvenue : ' . $user['nom'].' '.$user['prenom'].'  :) - <a href="deconnexion.php">Deconnexion</a> ';
        ?>    



        <form method='GET' id="search">
            <input type='search' name='search' placeholder='rechercher' autocomplete='off'> 
            <input type="submit" value='cherche'>
        </form>


        <?php    

            if(isset($_GET['id'])){ /* SI on est dans une entreprise */
                $_GET['id'] = htmlspecialchars($_GET['id']);
                $requete = $bdd->prepare('SELECT * FROM entreprise WHERE id = :id');
                $requete->execute(array('id'=>$_GET['id']));
                while($reponse = $requete->fetch()){
            ?>
                    <div class="categories">
                        <h1><?php echo $reponse['entreprise']; ?></h1>
                    </div>
            <?php 
                    echo "<li>". $reponse['ville']."</li>";
                    echo "<li>". $reponse['adresse']."</li>";
                    echo "<li>". $reponse['code_postal']."</li>";
                    echo "<li>". $reponse['categorie']."</li>";
                    echo "<li>". $reponse['tel']."</li>";
                }
            }
            else { /* Si on est sur la page normale */
            ?>
                <section>
            <?php
                if($allent->rowCount() > 0) {
                    while($entreprise = $allent->fetch()) {
            ?>
                        <div class="categories">
                            <a href="entreprise.php?id=<?php echo $entreprise['id']; ?>"><?php echo $entreprise['entreprise']; ?></a>
                        </div>

            <?php }}else{ ?>

                        <p>Aucun résultat trouvé</p> 

            <?php } ?>

                </section>
            <?php } ?>

    </div>

</body>
</html>
