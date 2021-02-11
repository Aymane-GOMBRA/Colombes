<?php
include_once('animal.class.php');

class Human extends Animal{
    //Propriété privée
    private $fname='';

    //Constructeur
    public function __construct(string $newFName, string $newDob)
    {
        //Valorise les attributs
        $this->setFName($newFName);
        $this->setDob($newDob);
        //Incrémente le nombre d'instances
        parent::$nb++;

    }
    //Accesseurs/Mutateurs
    //poids : 1kg
    public function setWeight(string $newWeight)
    {
        if($newWeight >= 1 && $newWeight <= 300){
            $this->weight = $newWeight;
        }else{
            throw new Exception('Le poids doit être compris entre 1kg et 300kg');
        }
    }
    public function getFName(): string
    {
        return $this->fname;
    }

    public function setFName(string $newFName){
        $this->fname=$newFName;
    }
}
?>