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

    $(document).on('change','.tipo-check',function(){
        filtrarPorTipos();
    });
});


function filtrarPorTipos(){
    let tipos =[];

    $('input[type="checkbox"]:checked').each(function(){
        tipos.push($(this).val());
    });

    $.ajax({
        url:"../../controller/pokemon.php?op=filtrar",
        type:"POST",
        data:{'tipos[]':tipos},
        traditional:true,
        success:function(data){
            console.log(data);
            $("#listpokemon").html(data);
        }
    });
}