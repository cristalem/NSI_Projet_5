<?php session_start();
include_once 'function/function.php';
include_once 'function/addSujet.class.php';
include_once 'function/mise_en_page.php';
$bdd = bdd();

$jours = array("Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi", "Dimanche");


if (isset($_POST['name']) 
AND isset($_POST['categorie'])
AND isset($_POST['prix']) 
AND isset($_POST['entreprise']) 
AND isset($_POST['description'])
AND isset($_POST['horaires'])) {

// Ici on veut passer du contenu du POST tel:
// horaires[0][1]: on
// horaires[0][2]: on
// horaires[0][3]: on

// A la base de donnees
// lundi: 1 2 3

    $horaires = array();
    $postHoraires = $_POST['horaires']; // array(int=>array(int=>string))
    //var_dump($postHoraires);
    foreach ($postHoraires as $jourHoraire=>$jourHoraires) {
        $jourBdd = strtolower($jours[$jourHoraire]);
        foreach ($jourHoraires as $heure=>$valeur) {
            if ($valeur === "on") {
                if (!isset($horaires[$jourBdd])) {
                    $horaires[$jourBdd] = "$heure";
                } else {
                    $horaires[$jourBdd] .= " $heure";
                }
            }
        }
    }

    $addSujet = new addSujet(
        $_POST['name'],
        $_POST['categorie'],
        $_POST['prix'],
        $_POST['entreprise'],
        $_POST['description'],
        $horaires);
    
   
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

<body>
    <header>

        <div class="topnav">
            <a class="active" href="index.php">Home</a>

        </div>

    </header>
 <h1>Ajouter un service</h1>
    
    <div id="Cforum">
    <?php
        include_once 'function/bienvenue.php';
        ?>                
        <form method="post" action="addSujet.php">
            <p>
                <br><input type="text" name="name" placeholder="Nom du service..." required/><br>
                <textarea name="description" placeholder="description..."></textarea><br>
                
                <select name="categorie" id="liste">
<!-- TODO SELECT (table CATEOGRIES) ????????????????????????????????????????????????????????? -->
                    <option value="garage">garage</option>
                    <option value="coiffeur">coiffeur</option>
                    <option value="esthetisienne">esthetisienne</option>
                    <option value="dentiste">dentiste</option>
                    <option value="reparation informatique">reparation informatique</option>
                </select><br>
    
                <input type="number" name="prix" placeholder="prix..." required/><br>
                <input type="text" name="entreprise" placeholder="entreprise..." required/><br>
                
                <table id="tableh">
                    <tr>
                        <td></td> <!-- Colonne vide pour l'en-tête -->
<?php
for ($i = 0; $i < 24; $i++) {
    echo "<td><b>" . $i . "h</b></td>";
}
?>
                    </tr>
<?php
foreach ($jours as $i=>$jour) {
    echo "<tr><td><b>$jour</b>";
    for ($j = 0; $j < 24; $j++) {
        echo '<td><input type="checkbox" name="horaires[' . $i . '][' . $j . ']"></td>';
    }
}
?>
                </table>

                <input type="submit" value="Ajouter le service" />


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
