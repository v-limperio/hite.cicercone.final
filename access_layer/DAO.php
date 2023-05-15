<?php 
    class DAO{
        protected $primary_key;
        protected $table_name;

        public function create($fields){
            $set_fields = '';

            // setta le variabili da inserire
            while (list($field, $value) = each($fields)){
                if($value != '' AND $field != 'pk'){
                    $set_fields .= "$field ='". mysqli_escape_string($this->connection, $value) ."', "; 
                }
            }

            // rimuove l'ultima virgola
            $set_fields = substr($set_fields,0,-2);
            echo "SETFIELDS";
            echo'<pre>';print_r($set_fields);echo'</pre>';

            // query
            $query = "INSERT INTO ".$this->table_name." SET ".$set_fields."";


            if(!mysqli_query($this->connection, $query)){
                $_SESSION['error'] = mysqli_error($this->connection);
                echo mysqli_error($this->connection);
            }
        }

        public function read_by_pk($pk){
            $query = "SELECT * FROM ".$this->table_name." WHERE ".$this->primary_key." = ('$pk')";
            $result = $this->connection->query($query);
            
            return $result;
        }

        public function read_by_field($fields){
            $where = array();

            // Se un operatore è settato, lo assegni alla variabile.
            if(isset($this->operator)) $operator = $this->operator;
            else $operator = '='; // altrimenti imposti al valore di default.

            //Riempi il vettore Where con le clausole.
            while (list($field, $value) = each($fields)){
                if($value != ''){
                    $where[] = " $field $operator'". mysqli_escape_string($this->connection, $value) ."'"; 
                }
            }

            $query = $this->format_query($where);
            self::print_log($query);

            $result = $this->connection->query($query);
            
            return $result;
        }

        public function update($pk, $fields){
            $set_fields = '';

            // setta le variabili da modificare
            while (list($field, $value) = each($fields)){
                if($value != '' AND $field != 'pk'){
                    $set_fields .= "$field ='". mysqli_escape_string($this->connection, $value) ."', "; 
                }
            }

            // rimuove l'ultima virgola
            $set_fields = substr($set_fields,0,-2);

            // query
            $query = "UPDATE ".$this->table_name." SET ".$set_fields." WHERE ".$this->primary_key." = ('$pk')";
            DAO::print_log($query); //Viene ignorata nel momento in cui chiami le viste

            if(!mysqli_query($this->connection, $query)){
                $_SESSION['error'] = mysqli_error($this->connection);
                echo mysqli_error($this->connection);
            }
        }

        public function delete($pk){
            $query = "DELETE FROM ".$this->table_name." WHERE ".$this->primary_key." = ('$pk')";

            if(!mysqli_query($this->connection, $query)){
                $_SESSION["error"] = mysqli_error($this->connection);
            }
        }

        private function format_query($where){
        $query = "SELECT * FROM ".$this->table_name."";

            // concatena le clausole where
            if(count($where) > 0){
                $query .= " WHERE BINARY ". implode(' AND BINARY', $where);
            }

            // concatena order by se settato
            if(isset($this->orderby)) $query .= "ORDER BY ".$this->orderby."";
            
            // concatena limit se settato
            if(isset($this->limit)) $query .= "LIMIT ".$this->limit."";
            return $query;
        }

        public static function print_log($log){
            echo'<pre>';print_r($log);echo'</pre>';
        }
    }
?>