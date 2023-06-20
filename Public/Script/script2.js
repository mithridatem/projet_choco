let check = document.querySelectorAll('.choco');
const result = document.querySelector('#result');
let url = "http://localhost:8080/projet_choco/api/chocoFilter?filter=";
console.log(check)
const affiche = fetch(url+1).then(async response =>{
    console.log(await response.json());
})
check.forEach(e=>{
    e.addEventListener('change',()=>{
        if(e.checked){
            let id = e.value;
            console.log('checkbox cochée : '+id);
            check.forEach(el=>{
                //si la checkbox est différente de la checkbox sélectionnée
                if(el.value!=id){
                    //on passe la checkbox à false (déchoché)
                    el.checked = false;
                    console.log('checkbox '+el.value+' déchochée');
                }
            });
            /* if(id==1){
                check[1].checked = false;
                check[2].checked = false;
                check[3].checked = false;
                id = 1;
            }
            if(id==2){
                check[0].checked = false;
                check[2].checked = false;
                check[3].checked = false;
                id = 2;
            }
            if(id==3){
                check[0].checked = false;
                check[1].checked = false;
                check[3].checked = false;
                id = 3;
            }
            if(id==4){
                check[0].checked = false;
                check[1].checked = false;
                check[2].checked = false;
                id = 4;
            } */
            fetch("http://localhost:8080/projet_choco/api/chocoFilter?filter="+id)
            .then(async response =>{
                console.log(await response.json());
            })
        }
    })
})

