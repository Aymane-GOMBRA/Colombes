<?php
/**
 * Renvoie les années de différences entre 2 dates
 * @param {string} $date1 - une date
 * @param {string} $date2 - une date
 * @return {int} - la diff d'année
 */

function age($date1, $date2):int{
    //Teste si les arguments sont bien des dates
    if(!is_date($date1) || !is_date($date2)){
        trigger_error('L\'un des arguments n\' est pas une date', E_USER_WARNING);
    }
    //transforme les dates de string en timestamp
    $d1=strtotime($date1);
    $d2=strtotime($date2);
    //cherche la date la plus forte et la plus faible
    if($d1>$d2){
        $diff=$d1-$d2;
    }elseif ($d2>$d1){
        $diff=$d2-$d1;
    }else{
        $diff = 0;
    }
    //renvoie le résultat
    return floor($diff/60/60/24/365.25);
}

/**
 * Renvoie true si la chaine passée en parametre est une date
 * @param {string} $arg - argument a tester
 * @return {boolean}
 */
function is_date($arg):bool{
    return (bool) strtotime($arg);
}

//Renvoie le montant TTC à partir d'un montant HT (tva dans un tableau)
function tva($mt, $taux=0.2){
    $vat=[0.021, 0.055, 0.1, 0.2];
    $result = 0.0;
    if($mt<0){
        trigger_error('Le prix existe pas',E_USER_WARNING);
    } elseif(!in_array($taux,$vat, true)){
        trigger_error('Les tva sont : '.implode(', ', $vat), E_USER_WARNING);
    } else {
        $result = $mt * (1+$taux);
    }
    return $result;
}

function secret_gen( int $len=8):string {
    $pass = "";
    $dico = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+*/$#';
    for ( $x = 1; $x <= random_int( 1, 10 ); $x++ ){
        $dico = str_shuffle( $dico );
    }
    for ( $s = 1; $s <= $len; $s++ ) {
        $pass .= substr( $dico, random_int( 0, 86 ), 1 );
    }
    return $pass;
}

function generatePassword(int $len = 8):string{
    $dico = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+*/$#';
    $pass = str_shuffle($dico);
    $pass=substr($pass,0,$len);
    return $pass;
}

function generatePassword2(int $len = 8){
    $upper = range('A', 'Z');
    $lower = range('a', 'z');
    $num = range(0,9);
    $symbols = array('+', '*', '/', '$', '#');
    $dico = array_merge($upper, $lower, $num, $symbols);
    shuffle($dico);

    if($len<8){
        trigger_error('8 caractères minimum.',E_USER_NOTICE);
    }

    $pass='';
    for($i=0;$i<$len;$i++){
        $pass.=$dico[rand(0, count($dico)-1)];
    }
}

function generateSelect(array $array){
    $html = '<select>';
    foreach($array as $key=>$val){
        $html.='<option value="'.$key.'">'.$val.'</option>';
    }
    $html .= '</select>';
    return $html;
}

function fAverage(){
    $r=0;
    for($i=0;$i<func_num_args();$i++){
        $r += func_get_arg($i);
    }
    $r /= func_num_args();
    return $r;
}

function fAverage2(){
    $r=0;
    $nb=0;
    $numbers=array();
    if(func_num_args()===1 && is_array(func_get_arg(0))){
        $numbers=func_get_arg(0);
    }else{
        $numbers=func_get_args();
    }

    for($i=0;$i<count($numbers);$i++){
        if(is_numeric($numbers[$i])){
            $r += $numbers[$i];
            $nb++;  
        }
    }
    $r /= $nb;
    return $r;
}
?>