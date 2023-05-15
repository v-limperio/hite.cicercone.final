<?php  
    interface iutenteDAO{
        public function create($fields);
        public function read_by_pk($pk);
        public function read_by_field($fields);
        public function update($pk, $fields);
        public function delete($pk);
    }

    require_once "DAO.php";
    class utenteDAO extends DAO implements iutenteDAO{
        public function __construct($connection){
            $this->table_name = "utente";
            $this->primary_key = "id";
            $this->connection = $connection;
        }
    }
?>