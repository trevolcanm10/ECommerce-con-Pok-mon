<?php
require_once("../config/conexion.php");
require_once("../models/Pokemon.php");

$pokemon = new Pokemon();

switch($_GET["op"]){

    case "listar":
        $datos=$pokemon->get_pokemon();
        foreach($datos as $row){
            ?>
                <div class="col-sm-4 col-lg-3 col-md-3">
                        <div class="pokemon text-center">
                            <img src="https://img.pokemondb.net/sprites/black-white/anim/normal/bulbasaur.gif" alt="" class="img-responsive">
                            <p>001</p>
                            <h4>Bulbasor</h4>
                            <h5>Grass</h5>
                            <p>Ataque:100</p>
                            <p>Defensa:100</p>
                        </div>
                </div>
            <?php
        }
}
?>