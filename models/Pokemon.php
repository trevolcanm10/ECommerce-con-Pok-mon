<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

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

        public function filtrar_tipos($tipos){
            $conectar = parent::conexion();//Parent, usamos el método conexion de Conectar
            parent::set_names();//Funcion que permite gestionar tildes o ñ

            if(empty($tipos)){
                $sql = "SELECT * FROM tm_pokemon";
                $sql = $conectar->prepare($sql);
                $sql->execute();
                return $sql->fetchALL(PDO::FETCH_ASSOC);
            }
            //Preparamos los "?" dependiendo de cuántos tipos marcó el usuario
            //Ejemplo: si $tipos = ['Agua','Fuego'], entonces: "?,?"
            $placeholders=implode(',',array_fill(0,count($tipos),'?'));
            //Busca Pokemón cuyo tipo esté en cualquiera de los tipos seleccionados
            $sql = "SELECT * FROM tm_pokemon WHERE tipo IN ($placeholders)";
            //Preparacion de la orden
            $sql = $conectar->prepare($sql);
            
            //Colocamos cada tipo dentro de los ? en orden correcto y seguro
            foreach ($tipos as $i => $tipo) {
                $sql->bindValue($i+1,$tipo);
            }

            //Enviamos los tipos seleccionados a la consulta
            $sql->execute();
            return $sql->fetchALL(PDO::FETCH_ASSOC);
        }
    }

?>