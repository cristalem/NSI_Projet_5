<?php //affiche bienvenue suivie du nom et prenom de la personne connecter (reutiliser sur plusieurs page)
include_once 'function/function.php';
$bdd = bdd();

    $nom = $bdd->prepare('SELECT * FROM membre_pro WHERE email = :email
    UNION SELECT * FROM membre_client WHERE email = :email');
    $nom->execute(array('email' => $_SESSION['email']));
        $user = $nom->fetch();
        echo 'Bienvenue : ' . $user['nom'].' '.$user['prenom'].'  :) - 
        <a href="deconnexion.php">
            <button>
                <i class="fa-solid fa-power-off"></i>
            </button>
        </a> ';
    ?>  