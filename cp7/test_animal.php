<?php
include_once('animal.class.php');
echo '<h2>Test 1 : Instanciation</h2>';
$obj1 = new Animal;
$obj1->name='Milou';//valorisation attribut

var_dump($obj1);
echo '<p>'.$obj1->move();//appel méthode
?>