$(document).ready(function(){
    $("#update_button").click(function(){
        $("#update_form").toggle();
    });

    $("#update_id_button").click(function(){
        $("#update_id_form").toggle();
    });

    $("#menu").click(function(e){
        e.stopPropagation();
        $("#navmenu").toggle();
    });
    
    $("body").click(function(){
        $("#navmenu").hide();
    });
});