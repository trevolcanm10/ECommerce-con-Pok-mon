console.log("Test");

//Espera que la página cargue
$(document).ready(function(){
    //Pide al servidor la lista de pokemones
    $.ajax({
        url:"../../controller/pokemon.php?op=listar",
        dataType:"html",//Respuesta que espera el servidor será texto HTML
        success:function(data){
            $("#listpokemon").html(data);
        }
    })

    $.ajax({
        url:"../../controller/pokemon.php?op=tipo",
        dataType:"html",
        success:function(data){
            console.log(data);
            $("#listipo").html(data);
        }

    })
});