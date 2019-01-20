$(document).ready(function(){
    $('#galerie').hide();
    
    $('#meetic_form').submit(function(e){
        e.preventDefault();
        $.ajax({
            url : "controllers/action_meetic.php",
            type: "post",
            data: $(this).serializeArray(),
            success: function(result){
                $(".slider").html(result);
                $("#galerie").show();
            },
            error: function(jqXHR, textStatus, errorThrown){
                alert("Erreur :"+jqXHR.status+jqXHR.responseText);
                console.log(textStatus);
                console.log(jqXHR);
                console.log(errorThrown);
            }
        });
        return false;
    });
});