console.log("Test");


$(document).ready(function(){
    $.ajax({
        url:"../../controller/pokemon.php?op=listar",
        dataType:"html",//Respuesta que espera el servidor será texto HTML
        success:function(data){
            $("#listpokemon").html(data)
            console.log(data);
        }
    })
});