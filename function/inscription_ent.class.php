<?php  session_start();
include_once 'function.php'; 

class inscription{

    private $entreprise;
    private $ville;
    private $categorie;
    private $adresse;
    private $code_postal;
    private $tel;
    private $bdd;
   
    public function __construct($entreprise,$ville,$categorie,$adresse,$code_postal,$tel){
        
        $entreprise = htmlspecialchars($entreprise);
        $ville = htmlspecialchars($ville);
        $categorie = htmlspecialchars($categorie);
        $adresse = htmlspecialchars($adresse);

        $this->entreprise = $entreprise;
        $this->ville = $ville;
        $this->categorie = $categorie;
        $this->adresse = $adresse;
        $this->code_postal = $code_postal;
        $this->tel = $tel;
        $this->bdd = bdd();
        
    }
    
    public function verif(){

        

        return 'ok';

    }
        
    public function enregistrement() {
        $requete = $this->bdd->prepare(
            'INSERT INTO entreprise(entreprise,ville,categorie,adresse,code_postal,tel) 
            VALUES(:entreprise,:ville,:categorie,:adresse,:code_postal,:tel)');
    
        $requete->execute(array(
            'entreprise' => $this->entreprise,
            'ville' => $this->ville,
            'categorie' => $this->categorie,
            'adresse' => $this->adresse,
            'code_postal' => $this->code_postal,
            'tel' => $this->tel   
        ));
        
        return 1;
    }
     
    
}

