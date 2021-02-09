<?php
class Animal
{
    //Propriétés publique
    public $name='';

    //Propriétés privées
    private $type='';
    private $color='';
    private $weight=0.0;

    //Accesseur/Mutateurs (Getters/Setters)
    public function getType():string
    {
        return $this->type;
    }
    public function setType(string $newType){
        $this->type = $newType;
    }

    //Méthode publique pour se déplacer
    public function move(): string
    {
        return 'Je me deplace';
    }
}
?>