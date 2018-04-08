var liens = document.querySelectorAll('a.link')
for(i = 0 ; i < liens.length ; i++){
    var lien = liens[i]
    lien.addEventListener('click', function(event){

        var confirm = window.confirm("Voulez-vous quitter ce site ?")
        if(confirm === false)
            event.preventDefault() 
    })
}
document.querySelector('p').addEventListener('click', function (e) {
    console.log("J'ai cliqué sur "+this.id)
})
