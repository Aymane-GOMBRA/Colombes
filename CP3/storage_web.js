/**
 * Stockage local avec l'interface localStorage
 */
document.getElementById('saveLocal').addEventListener(
    'click',
    function(){
        //Purge toutes les données 
        localStorage.clear();
        //Met dans une variable tout les name du form
        let aElements = document.querySelectorAll('form [name]');
        //Stock la variable en boucle
        for(let i=0;i<aElements.length;i++){
            localStorage.setItem(aElements[i].name, aElements[i].value);
        }
    },
    false
);
