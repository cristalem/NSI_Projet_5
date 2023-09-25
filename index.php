<?php session_start();
include_once 'function/function.php';
include_once 'function/addPost.class.php';
$bdd = bdd();


if(!isset($_SESSION['id']) AND !isset($_SESSION['email'])){
  header('Location: inscription.php');
}/*si pas connecte revoie vers inscription*/

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
  <?php include_once 'function/mise_en_page.php';?>
  <body>
    <header>

      <div class="topnav">
        <a class="active" href="index.php">Home</a>
        <a href="entreprise.php">entreprise</a>
        <?php
        if (isset($_SESSION['id']) && isset($_SESSION['type']) && $_SESSION['type'] === 'pro') {
            echo '<a href="addSujet.php">ajouter un service</a>';
        }/*ca s'affiche que pour les pro*/
        ?>
          
      </div>
    </header>
    <h1>Bienvenue sur mon site !</h1>
    
    <div id="Cforum">
      <?php

      include_once 'function/bienvenue.php';

      if(isset($_GET['categorie'])){ /*SI on est dans une categorie*/
        $allsujet = $bdd->prepare('SELECT * FROM sujet WHERE categorie = :categorie');
        $allsujet->bindParam(':categorie', $_GET['categorie']);
        $allsujet->execute();

      if(isset($_GET['search']) AND !empty($_GET['search'])){ 
        $recherche = htmlspecialchars($_GET['search']); 
        $allsujet = $bdd->query('SELECT name FROM sujet WHERE name LIKE "%'.$recherche.'%" ORDER BY id DESC'
        ); /*la recherche par nom dans l'ordre decroissant*/
      }
      ?>


      <form method='GET' id="search">
          <input type="hidden" name="categorie" value="<?php echo $_GET['categorie']; ?>">
          <input type='search' name='search' placeholder='rechercher' autocomplete='off'> 
          <input type="submit" value="chercher" />
      </form><!-- barre de recherche -->

      <div class="categories">
          <h1><?php echo $_GET['categorie']; ?></h1><!-- affiche toutes les categories -->
      </div>

      <section class="afficher_recherche">
        <?php
        if($allsujet->rowCount() > 0) {
        /*affichage de la recherche si il y a au moins un resultat */

          while($sujet = $allsujet->fetch()) {
        ?>

        <div class="categories">
            <p> 
              <a href="index.php?id=<?php echo $sujet['id'] ?>"><h1><?php echo $sujet['name'] ?></h1></a> 
            </p>
        </div>

        <?php }}else{ /*si il y a pas de resultat*/?>

        <p>Aucun resultat trouvé</p> 

        <?php } ?>

      </section>
      
      <?php
      }
      
      else if(isset($_GET['id'])){ /*SI on est dans un sujet/services */
        $_GET['id'] = htmlspecialchars($_GET['id']);
        $requete = $bdd->prepare('SELECT * FROM sujet WHERE id = :id ');
        $requete->execute(array('id'=>$_GET['id']));
        while($reponse = $requete->fetch()){
        ?>

        <div class="categories">
          <h1><?php echo $reponse['name']; ?></h1>
        </div>

        <div class="w3-container">
          <ul class="w3-ul">
        <?php /*affichage des info sur le service*/
          echo "<li>". $reponse['entreprise']."</li>";
          echo "<li>". $reponse['prix']."€ </li>";
          echo "<li>". $reponse['description']."</li>";
        ?></ul>
        </div><br>

        <a href="reservation.php?id=<?php echo $_GET['id'] ?>">reservation</a>
        <br><div>
          <h3>commentaire</h3>
        </div><!-- section commentaire -->

        <form method="post" action="index.php?id=<?php echo $_GET['id']; ?>">
          <textarea name="sujet" placeholder="Votre message..." ></textarea>
          <input type="hidden" name="name" value="<?php echo $_GET['id']; ?>" />
          <input type="submit" value="Ajouter le commentaire" />
          <?php 
          if(isset($erreur)){
            echo $erreur;
          }
          ?>
        </form>
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
            echo '<br>';
            echo $reponse2['date'];
            echo ': <br>';
            
            echo $reponse2['contenu'];}}
          ?>
          </div> 
        <?php
      }


      else { /*Si on est sur la page normal affiche juste toutes les categorie par ordre alphabétique croissant*/
    
        $requete = $bdd->query('SELECT * FROM categories ORDER BY name ASC');
        while($reponse = $requete->fetch()){
          ?>
          <div class="categories">
            <a href="index.php?categorie=<?php echo $reponse['name']; ?>"><?php echo $reponse['name']; ?></a>
          </div>

          <?php 
        }  
      }?>
            
    </div>
  </body>
</html>
  <?php
}
?>
