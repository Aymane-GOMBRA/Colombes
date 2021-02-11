<?php
include_once('animal.class.php');
include_once('humain.class.php');
echo '<h2>Test 1 : Instanciation</h2>';
$obj1 = new Animal;
$obj1->name='Milou';//valorisation attribut
echo '<h3>Nombre de '.Animal::getNb().'</h3>';
echo '<p>'.$obj1->move();//appel méthode

echo '<h2>Test 2 : Utilisation des accesseurs</h2>';
$obj2 = new Animal;
$obj2->name='Snoopy';//valorisation attribut
$obj2->setType('Terrestre');
echo '<p>'.$obj2->name.': Type = '.$obj2->getType();
echo '<h3>Nombre de '.Animal::getNb().'</h3>';
$obj3 = new Animal;
$obj3->name='Dingo';//valorisation attribut
$obj3->setType('Terrestre');
$obj3->setColor('Bleu');
echo '<p>'.$obj3->name.': Type = '.$obj3->getType().', Couleur = '.$obj3->getColor();
echo '<h3>Nombre de '.Animal::getNb().'</h3>';
$obj4 = new Animal;
$obj4->name='Toutou';//valorisation attribut
$obj4->setType('Terrestre');
$obj4->setColor('Rose');
$obj4->setWeight(1100.0);
echo '<p>'.$obj4->name.': Type = '.$obj4->getType().', Couleur = '.$obj4->getColor().', Poids =  '.$obj4->getWeight().' kg';
echo '<h3>Nombre de '.Animal::getNb().'</h3>';
echo '<h2> Test 3 : Utilisation des constantes</h2>';
echo '<p>'.Animal::TYPE_WATER;

echo '<h2> Test 4 : Utilisation des constructeurs</h2>';
$obj5 = new Animal('Garfield', Animal::TYPE_GROUND, 'Orange et noir',7.8);
var_dump($obj5);
echo '<h3>Nombre de '.Animal::getNb().'</h3>';
echo '<h2> Test 5 : Appel des méthodes</h2>';
$obj6=new Animal('Titi', Animal::TYPE_AIR, 'Jaune', .3);
$obj7=new Animal('Sylvestre', Animal::TYPE_GROUND, 'Noir et Blanc', 5.25);
echo '<p>'.$obj6->move();
echo '<p>'.$obj7->move();
var_dump($obj6);
var_dump($obj7);
$obj7->eat($obj6);
var_dump($obj6);
var_dump($obj7);
echo '<p>'.$obj6->name.': Type = '.$obj6->getType().', Couleur = '.$obj6->getColor().', Poids =  '.$obj6->getWeight().' kg';
echo '<p>'.$obj7->name.': Type = '.$obj7->getType().', Couleur = '.$obj7->getColor().', Poids =  '.$obj7->getWeight().' kg';
echo '<h3>Nombre de '.Animal::getNb().'</h3>';
unset($obj6);
echo '<h3>Nombre de '.Animal::getNb().'</h3>';
echo '<h2>Test 6 : Valeur par défaut vs Mutateur</h2>';
$obj8=new Animal('Jolly Jumper', Animal::TYPE_GROUND, 'Blanc', 895.5, '2001-01-01');
var_dump($obj8);
$obj8->setDob('2546-01-01');
var_dump($obj8);
$obj9=new Human('Aymane', '2001-01-01');
var_dump($obj9);
$obj9->setWeight(120);
var_dump($obj9);
?>