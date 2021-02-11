// document.getElementsByTagName('form')[0].addEventListener(
//     'submit',
//     function(evt){
//         let pass = document.getElementById('pass').value;
//         let check = document.getElementById('check').value;
//         if(pass!==check){
//             evt.preventDefault();
//             alert('Les mots de passe ne correspondent pas.');
//         }else {
//             return true;
//         }
//     },
//     false
// )

// document.getElementById('myForm').addEventListener(

//     'submit',
    
//     function(e){
//     e.preventDefault();
    
//     if(document.getElementById('pass').value === document.getElementById('check').value){
    
//     alert('OK');
    
//     document.getElementById('myForm').submit();
//     }else{
//     alert('NOK');
    
//     }
    
//     },false
    
//     );

// branche l'événement submit au seul formulaire de la page index
document.getElementsByTagName('form')[0].addEventListener(
    'submit',
    function(evt){
        evt.preventDefault();
        if(document.getElementById('check').value === document.getElementById('pass').value){
            this.submit();
        }else {
            alert('Les mots de passe doivent concordés.');
        }
    },
    false
)