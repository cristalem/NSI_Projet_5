<?php  session_start();
include_once 'function.php'; 


class inscription_client{
    
   private $nom;
   private $prenom;
   private $email;
   private $mdp;
   private $mdp2;
   private $bdd;
   
    public function __construct($nom,$prenom,$email,$mdp,$mdp2){
        
        $nom = htmlspecialchars($nom);
        $prenom = htmlspecialchars($prenom);
        $email = htmlspecialchars($email);
        
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->mdp = $mdp;
        $this->mdp2 = $mdp2;
        $this->bdd = bdd();
        
        
    }
    
    public function verif(){

        if(strlen($this->nom) < 3 || strlen($this->nom) > 20){ /*Si le pseudo est mauvais*/
            $erreur = 'Le nom doit contenir entre 3 et 20 caractères';
            return $erreur;
        }

        if(strlen($this->prenom) < 3 || strlen($this->prenom) > 20){ /*Si le pseudo est mauvais*/
            $erreur = 'Le prenom doit contenir entre 3 et 20 caractères';
            return $erreur;
        }
    
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
        $sql = "SELECT COUNT(*) AS nb FROM membre_client WHERE email = :email
        UNION SELECT COUNT(*) AS nb FROM membre_pro WHERE email = :email";
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
        $requete = $this->bdd->prepare('INSERT INTO membre_client(nom,prenom,email,mdp) VALUES(:nom,:prenom,:email,:mdp)');
    
        $requete->execute(array(
            'nom'=>  $this->nom,
            'prenom'=>  $this->prenom,
            'email' => $this->email,
            'mdp' => $this->mdp  
        ));

        
        
        
        return 1;
    }
        
        
    
    public function session(){
        $requete = $this->bdd->prepare('SELECT id FROM membre_client WHERE email = :email ');
        $requete->execute(array('email'=>  $this->email));
        $requete = $requete->fetch();
        $_SESSION['id'] = $requete['id'];
        $_SESSION['email'] = $this->email;
        
        return 1;
    }
    
    
    
}

