<?php 
    interface iattivitàDAO{
        public function create($fields);
        public function read_by_pk($pk);
        public function read_by_field($fields);
        public function update($pk, $fields);
        public function delete($pk);
    }

    require_once "DAO.php";
    class attivitàDAO extends DAO implements iattivitàDAO{
        public function __construct($connection){
            $this->table_name = "attivita";
            $this->primary_key = "id";
            $this->connection = $connection;
        }
    }
?>