<?php
//imports
include_once('constants.php');
include_once('singleton.class.php');
include_once('model.class.php');
//Test 1 : Connexion
Singleton::setConfiguration(HOST, 3306, DB, USER, PASS);

//Test 2 : Composant select
echo Singleton::getHtmlSelect('prod', 'SELECT * FROM produits where NO_FOURNISSEUR = ?', array(3));

//Test 3 : Composant table
echo Singleton::getHtmlTable('SELECT * FROM produits where NO_FOURNISSEUR = ?', array(3));


//MODEL

//Test 4 : Instanciation
$produits = new Model(HOST, 3306, DB, USER, PASS, 'produits');

//Test 5 : getRows
// var_dump($produits->getRows());

//Test 6 : getRow
// var_dump($produits->getRow('REF_PRODUIT', '5'));

//Test 7 : insert
$cat = new Model(HOST, 3306, DB, USER, PASS, 'categories');
$cat->insert(array(
    'CODE_CATEGORIE'=>667,
    'NOM_CATEGORIE'=>'Devil Cream',
    'DESCRIPTION'=>'Diaboliquement bon'
));

var_dump($cat->getRows());

//Test 7 : update
$cat->update(array(
    'CODE_CATEGORIE'=>999,
    'NOM_CATEGORIE'=>'Devil Creamy',
    'DESCRIPTION'=>'Diaboliquement good'
), 'CODE_CATEGORIE', 667);

