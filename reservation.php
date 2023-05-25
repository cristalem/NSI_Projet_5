<?php
session_start();
// VERIFIER UTILISATEUR CONNECTE?
include_once 'function/mise_en_page.php';
$jours = array("Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi", "Dimanche");

$idService = isset($_GET["id"]) ? $_GET["id"] : null;
$date = isset($_GET["date"]) ? strtotime($_GET["date"]) : null;

if (!$idService) {
    echo "Manque ID";
    exit();
}

if (isset($_POST["heure"])) {
    // TODO verifier heure valide (int, 0 <= heure <= 23)
    // TODO verifier si une resa existe deja (CF + bas (la verification est deja faite avant d'afficher les horaires dispos))
    if (!$date) {
        echo "Manque date";
        exit();
    }
    $heure = $_POST["heure"];

    include 'function/function.php';
    
    $requete = bdd()->prepare("INSERT INTO reservation(id_client, id_service, date, heure)
    VALUES(:client, :service, :date, :heure)");
    $result = $requete->execute([
        "client" => $_SESSION["id"],
        "service" => $idService,
        "date" => date("Y-m-d", $date),
        "heure" => $heure
    ]);
    if (!$result) {
        echo "Probleme insert";
        exit();
    }
    echo "OK";
    exit();
}
?>

<body>
    
    <header>

        <div class="topnav">
            <a class="active" href="index.php">Home</a>
        </div>

    </header>

    <h1>reservation</h1>
        
    <div id="Cforum">


<?php if (!$date) { ?>
    <form method="GET">
        <input hidden name="id" value="<?= $idService ?>">

        <label for="date"><b>Date :</b></label>

        <input type="date" id="date" name="date" required
            min="<?= date('Y-m-d'); ?>" max="<?= date('Y-m-d', strtotime('+1 year')) ?>">

        <input type="submit">
    </form>
<?php } else {
$jourSemaine = $jours[date("w", $date) - 1];    
?>
    <b>Date: <?= $jourSemaine ?> <?= date("d/m/Y", $date) ?></b>
    <?php
    include 'function/function.php';
    $bdd = bdd();
    $requete = $bdd->prepare("SELECT " . strtolower($jourSemaine) . " FROM horaires WHERE id_service = ?");
    $requete->execute(array($idService));
    $resultat = $requete->fetch();
    if (!$resultat) {
        echo "Service invalide";
        exit();
    }

    $horaires = $resultat[0];
    if (!$horaires) {
        echo "Aucun horaire disponible";
        exit();
    }

    $heures = explode(" ", $horaires);
    $requete = $bdd->prepare("SELECT heure FROM reservation WHERE id_service = ? AND date = ?");
    $requete->execute([$idService, date("Y-m-d", $date)]);
    while ($row = $requete->fetch()) {
        $h = $row[0];
        if (($cle = array_search($h, $heures))) {
            unset($heures[$cle]);
        }
    }

    if (!$heures) {
        echo "Aucun horaire disponible";
        exit();
    }
    ?>
    <form method="POST">
        <?php foreach ($heures as &$heure) { ?>
            <input type="radio" name="heure" value="<?= $heure ?>"><?= $heure ?>h
        <?php 
        }
        ?>
        <input type="submit">
    </form>
<?php } ?>
    </div>
</body>
</html>
