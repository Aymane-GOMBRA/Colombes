<?php

$projects = array(
    "NRJ" => array(
        "name" => "Energies renouvelables",
        "budget" => 400000,
        "technos" => array(
            "web" => array("html", "css", "JS"),
            "mobile" => array("React Native")
        )
    ),
    "H20" => array(
        "name" => "Traitement des eaux usées",
        "budget" => 750000,
        "technos" => array(
            "Client riche" => array("Java", "Oracle"),
            "RWD" => array("MangoDB", "Node", "Angular")
        )
    ),
    "RDC" => array(
        "name" => "Gestion des maraudes- Restos du Coeur",
        "technos" => array("Web Static" => array("HTML", "CSS", "JS"))
    )
);


//Génère un tableau HTML affichant le contenu de l'array projects

$html = '<table class ="table table-striped">';
$html .= '<thead><tr><th>Projets</th><th>Budget</th><th>Technologies</th></tr></thead><tbody>';

foreach($projects as $key=>$val){
    $html .='<tr>';
    $html .='<td>'.$key. ' - '.$projects[$key]['name'].'</td>';
    $html .='<td>'.(array_key_exists('budget', $projects[$key])?number_format($projects[$key]['budget'], 2, ',', ' ').'€': '') .'</td>';
    $html .='<td>';

    foreach($projects[$key]['technos']as $key2 => $val2){
        $html .='<li>'.$key2. '<ol>';

        foreach($projects[$key]['technos'][$key2] as $val3){
            $html .='<li>'.$val3. '</li>';
        }
        $html .='</ol></li>';
    } 
    $html .='</td>';
    $html .='</tr>';
}
$html .= '</tbody></table>';
echo $html;

?>