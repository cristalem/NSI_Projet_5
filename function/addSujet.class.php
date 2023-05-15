<?php include_once 'function.php';

class addSujet{
    
    private $name;
    private $categorie;
    private $prix;
    private $entreprise;
    private $note5;
    private $description;
    private $bdd;
    
    public function __construct($name,$categorie,$prix,$entreprise,$description) {
        
        $this->name = htmlspecialchars($name);
        $this->categorie = htmlspecialchars($categorie);
        $this->prix = htmlspecialchars($prix);
        $this->entreprise = htmlspecialchars($entreprise);
        $this->note5 = htmlspecialchars($note5);
        $this->description = htmlspecialchars($description);
        $this->bdd = bdd();
        
    }
    
    
    public function verif(){
        
        return 'ok';


        
    }
    

    public function insert(){
        
        $requete = $this->bdd->prepare(
            'INSERT INTO sujet(name,categorie,prix,entreprise,note5,description)
            VALUES(:name,:categorie,:prix,:entreprise,:note5,:description)');
        $requete->execute(array(
            'name'=> $this->name,
            'categorie'=>  $this->categorie,
            'prix'=>$this->prix,
            'entreprise'=>$this->entreprise,
            'note5'=>$this->note5,
            'description'=>$this->description,
        ));
        
        
        return 1;
    }

    private function uploadImage() {
        if ($this->image !== null) {
            $targetDir = "images/";
            $targetFile = $targetDir . $bdd($this->image);
            
            // Vérifiez si le fichier est une image
            $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
            $allowedTypes = array("jpg", "jpeg", "png", "gif");
            if (!in_array($imageFileType, $allowedTypes)) {
                // Gérez l'erreur ici
            }
            
            // Déplacez le fichier vers le dossier de destination
            if (!move_uploaded_file($this->image, $targetFile)) {
                // Gérez l'erreur ici
            }
            
            return $targetFile;
        }
        
        return null;
    }

    
}