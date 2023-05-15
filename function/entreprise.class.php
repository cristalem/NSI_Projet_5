<?php include_once 'function.php';
class entreprise{
    
    private $entreprise;
    private $ville;
    private $categorie;
    private $adresse;
    private $code_postal;
    private $tel;
    
    private $bdd;
    
    public function __construct($entreprise, $ville, $categorie, $adresse, $code_postal, $tel) {
        
        $this->entreprise = htmlspecialchars($entreprise);
        $this->ville = htmlspecialchars($ville);
        $this->categorie = htmlspecialchars($categorie);
        $this->adresse = htmlspecialchars($adresse);
        $this->code_postal = $code_postal;
        $this->tel = $tel;
        $this->bdd = bdd();
        
    }
    
    
    public function verif(){
        
        if(strlen($this->entreprise) > 1 AND strlen($this->entreprise) < 30 ){ /*Si le nom du entreprise est bon**/
            return 'ok';

        }else { /*Si le nom du entreprise est mauvais*/
            $erreur = 'Le nom de l\'entreprise doit contenir entre 1 et 30 caractères';
            return $erreur;
        }

        if(strlen($this->ville) > 0 AND strlen($this->ville) < 50 ){ /*Si ville bon*/
            return 'ok';

        }else {/*Si ville pas bon*/
            $erreur = 'Le nom de la ville doit contenir entre 1 et 50 caractères';
            return $erreur;
        }

        if(strlen($this->adresse) > 1 AND strlen($this->adresse) < 60 ){ /*Si le nom du adresse est bon**/
            return 'ok';

        }else { /*Si le nom du adresse est mauvais*/
            $erreur = 'Le nom de l\'adresse doit contenir entre 1 et 60 caractères';
            return $erreur;
        }
        if(strlen($this->code_postal) == 5 ){ /*Si code postal est bon**/
            return 'ok';

        }else { /*Si le code postal est mauvais*/
            $erreur = 'Le code postal doit contenir 5 caractères';
            return $erreur;
        }
        if(strlen($this->tel) == 10){ /*Si tel est bon**/
            return 'ok';

        }else { /*Si le let est mauvais*/
            $erreur = 'Le numero de telephone doit contenir 10 caractères';
            return $erreur;
        }

    }
    
    
    
}