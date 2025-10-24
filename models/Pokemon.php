<?php

    //Heredamos la extension de conectar
    class Pokemon extends Conectar{
        //Obtenemos todo los datos del pokemon
        public function get_pokemon(){
            $conectar = parent::conexion();//Parent, usamos el método conexion de Conectar
            parent::set_names();//Funcion que permite gestionar tildes o ñ
            $sql="select * from tm_pokemon";//Orden o consulta a la base de datos
            $sql = $conectar->prepare($sql);//Preparacion de la orden
            $sql->execute();//Se ejecuta la orden
            return $resultado=$sql->fetchAll(pdo::FETCH_ASSOC);
        }

        public function get_tipo(){
            $conectar = parent::conexion();//Parent, usamos el método conexion de Conectar
            parent::set_names();//Funcion que permite gestionar tildes o ñ
            $sql = "select distinct tipo from tm_pokemon";//Selecciona todos los tipos de la tabla, sin repertirlos
            $sql = $conectar->prepare($sql);//Preparacion de la orden
            $sql->execute();
            return $resultado=$sql->fetchAll(pdo::FETCH_ASSOC);
            
        }
    }

?>