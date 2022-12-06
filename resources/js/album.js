
let userId=document.querySelector("#userId")
let lienApi=("album/"+userId);
console.log(lienApi)
fetch(lienApi,{mode:'cors'})
    .then(function (response){
        return response.json();
    })
    .then(function (response){
       return response
    })
    .catch(function (error){
        return error;
    })

Alpine.start();
