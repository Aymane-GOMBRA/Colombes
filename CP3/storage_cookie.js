/**
 * Ecrit un cookie dans le domaine en cours
 * @param {string} name - nom du cookie
 * @param {string} value - valeur du cookie
 * @param {number} duration - durée de vie du cookie (en jours)
 */

 function writeCookie(name, value, duration) {
     //teste si duration est un nombre
     if(isNaN(duration)){
         throw 'La durée doit être un nombre de jours';
     } else {
         //date du jour
         var dToday = new Date();
         //ajoute la durée à aujourd'hui
         dToday.setTime(dToday.getTime()+duration*24*60*60*1000);
     }


     //ecrit le cookie
     document.cookie = name + '=' + value + ';expires=' + dToday.toLocaleString() + ';path=;SameSite=None;Secure';

 };

/**
 * Lit un cookie dans le domaine en cours
 * @param {string} name - nom du cookie
 * @return {string}
 */
function readCookie(name) {
    let aCookies = document.cookie.split(';');
    for (let i = 0; i<aCookies.length;i++){
        if(aCookies[i].trim().indexOf(name+ '=')===0){
            let aCookie = aCookies[i].split('=');
            return aCookie[1];
        }
    }
};

/**
 * Supprimer le Cookie dans le domaine en cours
 * @param {string} name - nom du cookie
 */
function eraseCookie(name){
    //Pour supprimer un cookie, on le créer avec une valeur vide et une durée négative
    writeCookie(name, '', -1);
};

/**
 * Fonction évenement pour gérer le click sur le bouton cookie
 */
if (document.getElementById('saveCookie')){
    document.getElementById('saveCookie').addEventListener(
        'click',
        function(){
            let sName = document.getElementById('fname').value;
            if(sName !== '') {
                let aValues = [];
            let aElements = document.querySelectorAll('form [name]:not([name=fname])');
            for(let i=0;i<aElements.length;i++){
               aValues.push(aElements[i].value);
            }
            let sValues = aValues.join(',');
            writeCookie(sName, sValues, 7);
            alert('Cookie sauvegardé avec succès.')
            } else {
                alert('Prénom obligatoire !')
            }
    
        },
        false
    );
}
/**
 * 
 */
if (document.getElementById('readCookie')){
    document.getElementById('readCookie').addEventListener(
        'click',
        function(){
            let rCookies = document.cookie.split(';');
            let rRow, rCell;
            document.getElementById('tblCookies').innerHTML='';
            for(let i = 0; i<rCookies.length;i++){
                let rCookie = rCookies[i].split('=');
                rRow = document.createElement('tr');
                rCell = document.createElement('td');
                rCell.textContent = rCookie[0].trim();
                rRow.appendChild(rCell);
                rCell = document.createElement('td');
                rCell.textContent=rCookie[1];
                rRow.appendChild(rCell);
                document.getElementById('tblCookies').appendChild(rRow);
            }
        },
        false
    );
}

if (document.getElementById('readLocal')){
    document.getElementById('readLocal').addEventListener(
        'click',
        function(){
            let lRow, lCell;
            document.getElementById('tblLocal').innerHTML='';
            for(let i=0;i<localStorage.length;i++){
                lRow = document.createElement('tr');
                lCell = document.createElement('td');
                lCell.textContent=localStorage.key(i);
                lRow.appendChild(lCell);
                lCell = document.createElement('td');
                lCell.textContent=localStorage.getItem(localStorage.key(i));
                lRow.appendChild(lCell);
                document.getElementById('tblLocal').appendChild(lRow);
            }
        },
        false
    )
}

if(document.getElementById('readIndexedDB')){
    document.getElementById('readIndexedDB').addEventListener(
        'click',
        function(){
            //Si IDB est supporté
        if(window.indexedDB){
            //ouvre la bdd
            let oIDB = window.indexedDB;
            let oCnn = oIDB.open('Darons-Coders', 1);
            
            oCnn.addEventListener(
                'error',
                function(evt){
                    alert('Erreur : '+ evt);
                },
                false
            );
            
            oCnn.addEventListener(
                'success',
                function(){
                    let oDB = oCnn.result;
                    let oTx = oDB.transaction(['Repertoire'], 'readonly');
                    let oStore = oTx.objectStore('Repertoire');
                    let oReq = oStore.openCursor();

                    //Si ouverture curseur KO
                    oReq.addEventListener(
                        'error',
                        function(){
                            alert('Erreur : '+ evt);
                        },
                        false
                    )
                    //Si l'ouverture du curseur OK
                    oReq.addEventListener(
                        'success',
                        function(evt){
                            let oCursor = evt.target.result;
                            let oRow, oCell;
                            if(oCursor) {
                                oRow=document.createElement('tr');
                                oCell=document.createElement('td');
                                oCell.textContent=oCursor.primaryKey;
                                oRow.appendChild(oCell);
                                oCell=document.createElement('tr');
                                oCell.textContent=JSON.stringify(oCursor.value);
                                oRow.appendChild(oCell);
                                document.getElementById('tblIndexedDB').appendChild(oRow);
                                console.log(oCursor.value);
                                oCursor.continue();
                            }
                        },
                        false
                    );
                    //Si transaction fini
                    oTx.addEventListener(
                        'complete',
                        function(){
                            oDB.close();
                        },
                        false
                    ); 
                },
                false
            );
            
        } else {
            alert('IDB non supporté sur ce navigateur');
        }
    
        },
        false
    )   
}