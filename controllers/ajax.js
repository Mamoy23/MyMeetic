$(document).ready(function(){
    $('#galerie').hide();
    
    $('#meetic_form').submit(function(e){
    //$(document).on("submit", "#meetic_form", function(e){
        e.preventDefault();
        $.ajax({
            url : "controllers/action_meetic.php",
            type: "post",
            data: $(this).serializeArray(),
            success: function(result){
                $(".slider").html(result);
                //$(result).hide().appendTo(".slider").fadeIn(1000);
                //$(result).appendTo(".slider").hide().fadeIn(300);

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

/*        e.preventDefault();
    
        var donnees = $(this).serialize();
    
        $.post(
            'controller.php',
            {
                data: donnees,
            },

            function(data){
                
            },

            'text'
        );*/

/*    $('#meetic_form').submit(function(){
        $("#loader").show();
        genre = $(this).find("input[name=genre]").val();
        age = $(this).find("input[name=age]").val();
        city = $(this).find("select[name=city]").val();
        $.post("controllers/action_meetic.php", {genre :genre, age: age, city: city}, function(data){
                $("#loader").hide();
        });
        return false;
    });*/