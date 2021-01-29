<?php
// //batterie de tests pour la fonction Age
require_once('fonctions.php');

// echo '<p>Test 1 :' .age(1234323224,12314141);
// echo '<p>Test 2 :' .age(1212,500);
// echo '<p>Test 3 :' .age('2010-01-01', '2020-01-01');
// echo '<p>Test 4 :' .age(500,500);
// echo '<p>Test 5 :' .age('zeaeeaze', 'azeazea');
// echo '<p>Test 6 :' .age('12/31/2005', '01/01/2019');
// echo '<p>Test 7 :' .age('Toto aime le coco', 'AZAZFNZIFN');
// echo '<p>Test 8 :' .age(123456789, 122121213);
// echo '<p>Test 9 :' .age('29/02/2021', '29/02/2001');

// //batterie de tests pour la fonction is_date
// echo '<p>Test 1 :' .is_date(1234323224);
// echo '<p>Test 2 :' .is_date(1212);
// echo '<p>Test 3 :' .is_date('2010-01-01');
// echo '<p>Test 4 :' .is_date(500);
// echo '<p>Test 5 :' .is_date('zeaeeaze');
// echo '<p>Test 6 :' .is_date('12/31/2005');
// echo '<p>Test 7 :' .is_date('Toto aime le coco');
// echo '<p>Test 8 :' .is_date(123456789);
// echo '<p>Test 9 :' .is_date('29/02/2021');


// echo '<p>Test 8 :' .ttc('aze', 0.055);

echo '<p>Test 8 :' .tva(100.0);
echo '<p>Test 9 :' .tva(100.0, 0.34);
echo '<p>Test 10 :' .tva(100.0, 0.055);
echo '<p>Test 11 :' .tva('toto', 0.1);
echo '<p>Test 12 :' .tva(100.0, 'tata');
echo '<p>Test 13 :' .tva(100);

echo '<p>Test 14 :' .secret_gen();
echo '<p>Test 14 :' .generatePassword();
echo '<p>Test 15 :' .generateSelect([]);
echo '<p>Test 16 :' .fAverage(10,20,30);
echo '<p>Test 17 :' .fAverage(10,'20', '2020-11-02');
echo '<p>Test 18 :' .fAverage(rand(1,9), rand(10,99),rand(100,999));
echo '<p>Test 19 :' .fAverage2(array(1,5,9,9,10));

?>