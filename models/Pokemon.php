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

        public function filtrar_tipos($tipos, $nombre, $ataque = null , $defensa = null){
            $conectar = parent::conexion();//Parent, usamos el método conexion de Conectar
            parent::set_names();//Funcion que permite gestionar tildes o ñ

            //Si hay tipos y/o nombre -> Construcción de una consulta combinada
            $sql = "SELECT * FROM tm_pokemon WHERE 1=1";

            //Filtro por nombre
            if(!empty($nombre)){
                $sql .= " AND nombre LIKE ?";
            }
            //Preparamos los "?" dependiendo de cuántos tipos marcó el usuario
            //Ejemplo: si $tipos = ['Agua','Fuego'], entonces: "?,?"
            //Si estamos filtrando tipos
            if(!empty($tipos)){
                $placeholders=implode(',',array_fill(0,count($tipos),'?'));
                //Busca Pokemón cuyo tipo esté en cualquiera de los tipos seleccionados
                $sql .= " AND tipo IN($placeholders)";
            }
            
            //Si el usuario mueve el slider de ataque
            if(!empty($ataque)){
                $sql .= " AND attack <= ?";
            }

            if(!empty($defensa)){
                $sql .= " AND defense <= ?";
            }
            //Preparacion de la orden
            $sql = $conectar->prepare($sql);
            $paramIndex=1;

            if(!empty($nombre)){
                $sql->bindValue($paramIndex++,"%".$nombre."%");
            }

            //Colocamos cada tipo dentro de los ? en orden correcto y seguro
            if(!empty($tipos)){
                foreach ($tipos as $tipo) {
                $sql->bindValue($paramIndex++,$tipo);
                }
            }
            
            if(!empty($ataque)){
                $sql->bindValue($paramIndex++,$ataque, PDO::PARAM_INT);
            }

            if(!empty($defensa)){
                $sql->bindValue($paramIndex++,$defensa, PDO::PARAM_INT);
            }
            //Enviamos los tipos seleccionados a la consulta
            $sql->execute();
            return $sql->fetchALL(PDO::FETCH_ASSOC);
        }
    }

?>