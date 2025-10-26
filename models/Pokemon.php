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

        public function filtrar_tipos($tipos, $nombre){
            $conectar = parent::conexion();//Parent, usamos el método conexion de Conectar
            parent::set_names();//Funcion que permite gestionar tildes o ñ

            //Si no hay tipos pero si nombre
            if(empty($tipos) && !empty($nombre)){
                $sql="SELECT * FROM tm_pokemon WHERE nombre LIKE ?";
                $sql = $conectar->prepare($sql);
                $sql->bindValue(1,"%".$nombre."%");//Le pasa el nombre para la consulta respectiva
                $sql->execute();
                return $sql->fetchAll(PDO::FETCH_ASSOC);
            }
            //Si no hay filtros mostrar todo
            if(empty($tipos)&& empty($nombre)){
                $sql = "SELECT * FROM tm_pokemon";
                $sql = $conectar->prepare($sql);
                $sql->execute();
                return $sql->fetchALL(PDO::FETCH_ASSOC);
            }

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

            //Enviamos los tipos seleccionados a la consulta
            $sql->execute();
            return $sql->fetchALL(PDO::FETCH_ASSOC);
        }
    }

?>