<?php include_once 'function.php';

class addSujet{//ajout de services
    
    private $name;
    private $categorie;
    private $prix;
    private $entreprise;
    private $note5;
    private $description;
    private $bdd;
    private $horaires;
    
    public function __construct($name,$categorie,$prix,$entreprise,$description,$horaires) {
        
        $this->name = htmlspecialchars($name);
        $this->categorie = htmlspecialchars($categorie);
        $this->prix = htmlspecialchars($prix);
        $this->entreprise = htmlspecialchars($entreprise);
        $this->note5 = htmlspecialchars($note5);
        $this->description = htmlspecialchars($description);
        $this->bdd = bdd();
        $this->horaires = $horaires;
    }
    
    
    public function verif(){
        
        return 'ok';


        
    }
    

    public function insert(){//ajout dans sujet les infos du services 
        
        $this->bdd->prepare(
            'INSERT INTO sujet(name,categorie,prix,entreprise,note5,description)
            VALUES(:name,:categorie,:prix,:entreprise,:note5,:description)'
        )->execute(array(
            'name'=> $this->name,
            'categorie'=>  $this->categorie,
            'prix'=>$this->prix,
            'entreprise'=>$this->entreprise,//c'est pas encore automatique donc on le rentre a la main
            'note5'=>$this->note5,//null j'ai pas encore fais
            'description'=>$this->description,
        ));

        $this->horaires += array("id_service" => $this->bdd->lastInsertId());
        var_dump($this->horaires);

        $this->bdd->prepare(
            "INSERT INTO horaires(". implode(",", array_keys($this->horaires)) .")
            VALUES(:".implode(",:", array_keys($this->horaires)).")"
        )->execute($this->horaires);
        
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