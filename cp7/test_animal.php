<?php
include_once('animal.class.php');
echo '<h2>Test 1 : Instanciation</h2>';
$obj1 = new Animal;
$obj1->name='Milou';//valorisation attribut

echo '<p>'.$obj1->move();//appel méthode

echo '<h2>Test 2 : Utilisation des accesseurs</h2>';
$obj2 = new Animal;
$obj2->name='Snoopy';//valorisation attribut
$obj2->setType('Terrestre');
echo '<p>'.$obj2->name.': Type = '.$obj2->getType();

$obj3 = new Animal;
$obj3->name='Dingo';//valorisation attribut
$obj3->setType('Terrestre');
$obj3->setColor('Bleu');
echo '<p>'.$obj3->name.': Type = '.$obj3->getType().', Couleur = '.$obj3->getColor();

$obj4 = new Animal;
$obj4->name='Toutou';//valorisation attribut
$obj4->setType('Terrestre');
$obj4->setColor('Rose');
$obj4->setWeight(1100.0);
echo '<p>'.$obj4->name.': Type = '.$obj4->getType().', Couleur = '.$obj4->getColor().', Poids =  '.$obj4->getWeight().' kg';

echo '<h2> Test 3 : Utilisation des constantes</h2>';
echo '<p>'.Animal::TYPE_GROUND;

echo '<h2> Test 4 : Utilisation des constructeurs</h2>';
$obj5 = new Animal('Garfield', Animal::TYPE_GROUND, 'Orange et noir',7.8);
var_dump($obj5);

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
?>