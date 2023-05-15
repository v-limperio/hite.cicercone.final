<?php  
    interface ivalutazioneDAO{
        public function create($fields);
        public function read_by_pk($pk);
        public function read_by_field($fields);
        public function update($pk, $fields);
        public function delete($pk);
    }

    require_once "DAO.php";
    class valutazioneDAO extends DAO implements ivalutazioneDAO{
        public function __construct($connection){
            $this->table_name = "valutazione";
            $this->connection = $connection;
        }

        public function update($pk, $fields)
        {
            $set_fields = '';

            
    
            // Se un operatore è settato, lo assegni alla variabile.
            if (isset($this->operator)) $operator = $this->operator;
            else $operator = '='; // altrimenti imposti al valore di default.
    
            //Riempi il vettore Where con le clausole.
            while (list($field, $value) = each($pk)) {
                if ($value != '') {
                    $where[] = " $field $operator'" . mysqli_escape_string($this->connection, $value) . "'";
                }
            }
    
    
            // setta le variabili da modificare
            while (list($field, $value) = each($fields)) {
                if ($value != '' and $field != 'pk') {
                    $set_fields .= "$field ='" . mysqli_escape_string($this->connection, $value) . "', ";
                }
            }
    
            // rimuove l'ultima virgola
            $set_fields = substr($set_fields, 0, -2);
            self::print_log($set_fields);
            // query
            $query = "UPDATE " . $this->table_name . " SET " . $set_fields;
    
            $query = $this->format_query($query, $where);
    
            DAO::print_log($query); //Viene ignorata nel momento in cui chiami le viste
            mysqli_query($this->connection, $query);
    
            if ((mysqli_error($this->connection))) {
                $_SESSION["error"] = mysqli_error($this->connection);
            }
        }


        private function format_query($query, $where)
        {
            // concatena le clausole where
            if (count($where) > 0) {
                $query .= " WHERE" . implode(' AND', $where);
            }
            return $query;
        }

    }
?>