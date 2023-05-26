<?php include_once 'function.php';

class connexion_pro{
    
    private $email; 
    private $mdp;
    private $bdd;
    
    public function __construct($email,$mdp) {
        $this->email = $email;
        $this->mdp = $mdp;
        $this->bdd = bdd();
    }
    
    public function verif(){
        
        $requete = $this->bdd->prepare('SELECT * FROM membre_pro WHERE email = :email');
        $requete->execute(array('email'=> $this->email));
        $reponse = $requete->fetch();
        if($reponse){
            
            if($this->mdp == $reponse['mdp']){
                return 'ok';
            }
            else {
                $erreur = 'Le mot de passe est incorrect';
                return $erreur;
            }
            
            
        }
        else {
            $erreur = 'Le email est inéxistant';
            return $erreur;
         }
        
        
    }
    
    public function session(){
        $requete = $this->bdd->prepare('SELECT id FROM membre_pro WHERE email = :email ');
        $requete->execute(array('email'=>  $this->email));
        $requete = $requete->fetch();
        $_SESSION['id'] = $requete['id'];
        $_SESSION['email'] = $this->email;
        $_SESSION['type'] = 'pro' ;
        
        return 1;
    }
    
    
}