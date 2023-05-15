<?php

require_once "DAO.php";
class richiestaDAO extends DAO
{

    public function __construct($connection)
    {
        $this->primary_key = array();
        $this->table_name = "richiesta";
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

        // query
        $query = "UPDATE " . $this->table_name . " SET " . $set_fields;

        $query = $this->format_query($query, $where);
        
        DAO::print_log($query); //Viene ignorata nel momento in cui chiami le viste
        mysqli_query($this->connection, $query);

        if ((mysqli_error($this->connection))) {
            $_SESSION["error"] = mysqli_error($this->connection);
        }
    }

    public function delete($pk)
    {
        $where = array();

        // Se un operatore è settato, lo assegni alla variabile.
        if (isset($this->operator)) $operator = $this->operator;
        else $operator = '='; // altrimenti imposti al valore di default.

        //Riempi il vettore Where con le clausole.
        while (list($field, $value) = each($pk)) {
            if ($value != '') {
                $where[] = " $field $operator'" . mysqli_escape_string($this->connection, $value) . "'";
            }
        }

        $query = $this->format_delete_query($where);
        echo $query;
        mysqli_query($this->connection, $query);

        if ((mysqli_error($this->connection))) {
            //$_SESSION["error"] = "Errore: L'orario inserito risulta già presente per l'attività selezionata";
            print_r(mysqli_error($this->connection));
        }
    }

    private function format_delete_query($where)
    {
        $query = "DELETE FROM " . $this->table_name . "";

        // concatena le clausole where
        if (count($where) > 0) {
            $query .= " WHERE" . implode(' AND', $where);
        }
        return $query;
    }

    private function format_query($query, $where)
    {
        // concatena le clausole where
        if (count($where) > 0) {
            $query .= " WHERE" . implode(' AND', $where);
        }
        return $query;
    }


    public static function print_log($log)
    {
        echo '<pre>';
        print_r($log);
        echo '</pre>';
    }
}
