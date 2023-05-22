<?php session_start();
include_once 'function/function.php';
include_once 'function/entreprise.class.php';
include_once 'function/mise_en_page.php';

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
            echo 'Bienvenue : ' . $user['nom'].' '.$user['prenom'].'  :) - 
            <a href="deconnexion.php">
                <button>
                    <i class="fa-solid fa-power-off"></i>
                </button>
            </a> ';
        ?>    



        <form method='GET' id="search">
            <input type='search' name='search' placeholder='rechercher' autocomplete='off'> 
            <button><i class="fa-solid fa-magnifying-glass"></i></button>
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
                <div class="w3-container">
                    <ul class="w3-ul">
                    <?php 
                        echo "<li>". $reponse['ville']."</li>";
                        echo "<li>". $reponse['adresse']."</li>";
                        echo "<li>". $reponse['code_postal']."</li>";
                        echo "<li>". $reponse['categorie']."</li>";
                        echo "<li>". $reponse['tel']."</li>";

                    ?> 
                    </ul>
                </div><?php 
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
