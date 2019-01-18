$(document).ready(function(){
    $("#update_button").click(function(e){
        e.stopPropagation();
        $("#update_form").toggle();
    });

    $("#update_id_button").click(function(e){
        e.stopPropagation();
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