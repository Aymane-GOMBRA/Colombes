window.addEventListener(
    'load',
    function(){
        //Tableau d'éléments html : boutons suppr
        let aBtns = document.querySelectorAll('table a.delete');
        //Parcours tous les éléments du tableau
        for (let i = 0; i<aBtns.length;i++){
            aBtns[i].addEventListener(
                'click',
                function(evt){
                    evt.preventDefault();
                    let bChoice=confirm('Souhaitez-vous vraiment supprimer cette ligne ?');
                    if (bChoice){
                        window.location=this.href;//ou evt.target.href
                    }
                },
                false
            )
        }
    },
    false
);