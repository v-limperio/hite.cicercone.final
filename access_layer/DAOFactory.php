<?php 
    interface iDAOFactory{
        public static function get_DAO($model_obj);
    }
    class DAOFactory implements iDAOFactory{
        public static function get_DAO($model_obj){
            require_once "DAO_list.php";

            // Connessione al database
            $connection = new mysqli("localhost", "root", "", "ciceronedb");

            //controlla se la connessione risulti corretta
            if($connection->connect_errno){
                echo "Connessione Fallita" . $connection->connect_error;
            }

            // Generazione DAO 
            $dao = get_class($model_obj)."DAO";
            return new $dao($connection);      
        }
    }
?>