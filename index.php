<?php session_start();
include_once 'function/function.php';
include_once 'function/addPost.class.php';
$bdd = bdd();


if(!isset($_SESSION['id']) AND !isset($_SESSION['pseudo'])){

    header('Location: inscription.php');
}
else {
    
    if(isset($_POST['name']) AND isset($_POST['sujet'])){
    
    $addPost = new addPost($_POST['name'],$_POST['sujet']);
    $verif = $addPost->verif();
    if($verif == "ok"){
        if($addPost->insert()){
            
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
            <a href="entreprise.php">entreprise</a>
            
        </div>
        <form>
            <input type="button" onclick="history.go(-1)" >

            <!-- class="fa-solid fa-arrow-left"></i> -->

        </form>
    </header>
 <h1>Bienvenue sur mon site !</h1>
    
    <div id="Cforum">
        <?php

        $nom = $bdd->prepare('SELECT * FROM membre_pro WHERE id = :id
        UNION SELECT * FROM membre_client WHERE id = :id');
        $nom->execute(array('id' => $_SESSION['id']));
        $user = $nom->fetch();
        echo 'Bienvenue : ' . $user['nom'].' '.$user['prenom'].'  :) - <a href="deconnexion.php">Deconnexion</a> ';
        


        


        if(isset($_GET['categorie'])){ /*SI on est dans une categorie*/
            $allsujet = $bdd->prepare('SELECT * FROM sujet WHERE categorie = :categorie');
            $allsujet->bindParam(':categorie', $_GET['categorie']);
            $allsujet->execute();




            if(isset($_GET['search']) AND !empty($_GET['search'])){ 
                $recherche = htmlspecialchars($_GET['search']); 
                $allsujet = $bdd->query('SELECT name FROM sujet WHERE name LIKE "%'.$recherche.'%" ORDER BY id DESC'
                ); 
            }
            ?>

        <form method='GET' id="search">
            <input type="hidden" name="categorie" value="<?php echo $_GET['categorie']; ?>">
            <input type='search' name='search' placeholder='rechercher' autocomplete='off'> 
            <input type="submit" value="chercher" />
        </form>



            <div class="categories">
                <h1><?php echo $_GET['categorie']; ?></h1>
            </div>

            <section class="afficher_recherche">
            <?php
            if($allsujet->rowCount() > 0) {


                while($sujet = $allsujet->fetch()) {
                ?>

            <div class="categories">
                <p> <a href="index.php?id=<?php echo $sujet['id'] ?>"><h1><?php echo $sujet['name'] ?></h1></a> </p>
            </div>

            

            <?php }}else{ ?>

            <p>Aucun resultat trouvé</p> 

            <?php } ?>

        </section>

        <a href="addSujet.php?categorie=<?php echo $_GET['categorie']; ?>">Ajouter un sujet</a>
     
            <?php
        }
        
        else if(isset($_GET['id'])){ /*SI on est dans un sujet*/
            $_GET['id'] = htmlspecialchars($_GET['id']);
            $requete = $bdd->prepare('SELECT * FROM sujet WHERE id = :id ');
            $requete->execute(array('id'=>$_GET['id']));
            while($reponse = $requete->fetch()){
            ?>
            <div class="categories">
                <h1><?php echo $reponse['name']; ?></h1>
            </div>

        <?php 
                    echo "<li>". $reponse['prix']."€ </li>";
                    echo "<li>". $reponse['entreprise']."</li>";
                    echo "<li>". $reponse['description']."</li>";
                    echo "<li>". $reponse['categorie']."</li>";
        
            ?>
            <div>
                <h3>commentaire</h3>
            </div>
        
            <?php 
            $requete2 = $bdd->prepare('SELECT * FROM postsujet WHERE sujet = :sujet ');
            $requete2->execute(array('sujet'=>$_GET['id']));
            while($reponse2 = $requete2->fetch()){
            ?>
            <div class="post">
            <?php
                $requete3 = $bdd->prepare('SELECT * FROM membre_pro WHERE id = :id
                UNION SELECT * FROM membre_client WHERE id = :id');
                $requete3->execute(array('id'=>$reponse2['propri']));
                $membres = $requete3->fetch();
                echo $membres['nom'];
                echo ' ';
                echo $membres['prenom'];
                echo ': <br>';
                
                echo $reponse2['contenu'];
            ?>
            </div> 
        <?php }} ?>
        
            <form method="post" action="index.php?id=<?php echo $_GET['id']; ?>">
                <textarea name="sujet" placeholder="Votre message..." ></textarea>
                <input type="hidden" name="name" value="<?php echo $_GET['id']; ?>" />
                <input type="submit" value="Ajouter à la conversation" />
                <?php 
                if(isset($erreur)){
                    echo $erreur;
                }
                ?>
            </form>
        <?php
        }


        else { /*Si on est sur la page normal*/
            
                $requete = $bdd->query('SELECT * FROM categories');
                while($reponse = $requete->fetch()){
                ?>
                    <div class="categories">
                        <a href="index.php?categorie=<?php echo $reponse['name']; ?>"><?php echo $reponse['name']; ?></a>
                        </div>
        
            <?php 
            }
            
        }
            ?>
            
    </div>
</body>
</html>
    <?php
}
?>

    
