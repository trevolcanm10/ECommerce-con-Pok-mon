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
    //Escucha un evento en los elementos con clase .tipo-check
    $(document).on('change','.tipo-check',function(){
        filtrarPorTipos();
    });

    $(document).on('input','#textnombre',function(){
        filtrarPorTipos();
    })
});


function filtrarPorTipos(){
    //Creamos un array vacío para guardar los tipos seleccionados
    let tipos =[];
    let nombre = $("#textnombre").val();

    //Recorremos todo los checkboxes que estén marcados
    $('input[type="checkbox"]:checked').each(function(){
        //Por cada checkbox marcado guardamos su valor dentro del array
        tipos.push($(this).val());
    });

    let dataToSend = {nombre:nombre}; //Siempre enviamos el nombre
    if(tipos.length > 0 ){
        dataToSend['tipos[]']=tipos;//Solo enviamos tipo si hay alguno seleccionado
    }

    //Enviamos al backend los tipos seleccionados usando AJAX
    $.ajax({
        //Ruta del controlador con la operación 'filtrar'
        url:"../../controller/pokemon.php?op=filtrar",
        //Método para enviar datos al servidor
        type:"POST",
        //Enviamos el array al backend como 'tipos[]' para que llegue como arreglo
        data:dataToSend,
        //Necesario para que JQuery envíe correctamente arrays
        traditional:true,
        success:function(data){
            //Mostramos en consola la respuesta del servidor
            console.log(data);
            $("#listpokemon").html(data);
        }
    });
}