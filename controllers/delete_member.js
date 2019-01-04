document.getElementById('delete_button').onclick = function(){
    res = confirm('Etes-vous sûr de vouloir vous désinscrire?');
    if(res){
        window.location.href = "?page=delete";
    }
}