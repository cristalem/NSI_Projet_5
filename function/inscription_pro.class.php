<?php  session_start();
include_once 'function.php'; 

class inscription_pro{

    private $nom;
    private $prenom;
    private $email;
    private $mdp;
    private $mdp2;
    private $bdd;
   
    public function __construct($email,$mdp,$mdp2,$nom,$prenom){
        
        
        $email = htmlspecialchars($email);
        $nom = htmlspecialchars($nom);
        $prenom = htmlspecialchars($prenom);

        $this->email = $email;
        $this->mdp = $mdp;
        $this->mdp2 = $mdp2;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->bdd = bdd();
        
    }
    
    public function verif(){

        
        $syntaxe = '#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#';
        if(!preg_match($syntaxe,$this->email)){ /*email mauvais*/
            $erreur = 'Syntaxe de l\'adresse email incorrect';
            return $erreur;
        }
    
        if(strlen($this->mdp) < 5 || strlen($this->mdp) > 20){ /*Si le mot de passe à le mauvais format*/
            $erreur = 'Le mot de passe doit contenir entre 5 et 20 caractères';
            return $erreur;
        }
    
        if($this->mdp != $this->mdp2){ /*Mots de passe différents*/
            $erreur = 'Les mots de passe doivent être identiques';
            return $erreur;
        }
    
        // Vérification de l'unicité de l'adresse email
        $sql = "SELECT COUNT(*) AS nb FROM membre_pro WHERE email = :email
        UNION SELECT COUNT(*) AS nb FROM membre_client WHERE email = :email";
        $stmt = $this->bdd->prepare($sql);
        $stmt->bindValue(":email", $this->email);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if($result["nb"] > 0){ /*Email déjà utilisé*/
            $erreur = 'Cette adresse email est déjà utilisée';
            return $erreur;
        }
    

        return 'ok';

    }
        
    public function enregistrement() {
        $requete = $this->bdd->prepare('INSERT INTO membre_pro(email,mdp,nom,prenom,type) VALUES(:email,:mdp,:nom,:prenom,:type)');
    
        $requete->execute(array(
            'email' => $this->email,
            'mdp' => $this->mdp,
            'nom' => $this->nom, 
            'prenom' => $this->prenom,
            'type' => 'pro' 
        ));
        
        return 1;
    }
      
    public function session(){
        $requete = $this->bdd->prepare('SELECT id FROM membre_pro WHERE email = :email ');
        $requete->execute(array('email'=>  $this->email));
        $requete = $requete->fetch();
        $_SESSION['id'] = $requete['id'];
        $_SESSION['email'] = $this->email;
        $_SESSION['type'] === 'pro';
        
        return 1;
    }
    
}

