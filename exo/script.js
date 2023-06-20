const result = document.querySelector('#result');
const compteur = document.querySelector('#compteur');
const nbr = prompt('Choisir le nombre de chekbox à afficher');
let cpt = 0;
if(Number.isInteger(parseInt(nbr))){
    for(let i = 0; i<nbr; i++){
        const check = document.createElement('input');
        const label = document.createElement('p');
        label.textContent = 'Checkbox '+(i+1);
        check.setAttribute('type', 'checkbox');
        check.setAttribute('value', i+1);
        check.setAttribute('class','ck');
        result.appendChild(label);
        result.appendChild(check);
    }
    const checklist = document.querySelectorAll('.ck');
    checklist.forEach(e=>{
        e.addEventListener('change', ()=>{
            if(e.checked){
                let id = e.value;
                e.previousSibling.style.color = 'green';
                cpt++;
                compteur.textContent = "Les checkbox ont été cochées "+cpt+" fois";
                checklist.forEach(e2=>{
                    if(e2.value!=id){
                        e2.previousSibling.style.color = 'black';
                        e2.checked = false;
                    }
                });
            }
            else{
                e.previousSibling.style.color = 'black';
            }
        });
    });
}
else{
    alert('Veuillez saisir un nombre !');
}