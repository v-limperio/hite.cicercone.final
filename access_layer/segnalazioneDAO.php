<?php  
    interface isegnalazioneDAO{
        public function create($fields);
        public function read_by_pk($pk);
        public function read_by_field($fields);
        public function update($pk, $fields);
        public function delete($pk);
    }

    require_once "DAO.php";
    class segnalazioneDAO extends DAO implements isegnalazioneDAO{
        public function __construct($connection){
            $this->table_name = "segnalazione";
            $this->connection = $connection;
        }
    }
?>