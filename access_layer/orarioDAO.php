<?php
interface iorarioDAO
{
    public function create($fields);
    public function read_by_pk($pk);
    public function read_by_field($fields);
    public function update($pk, $fields);
    public function delete($pk);
}

require_once "DAO.php";
class orarioDAO extends DAO implements iorarioDAO
{
    private $foreign_key;

    public function __construct($connection)
    {
        $this->table_name = "orario";
        $this->primary_key = array();
        $this->connection = $connection;
    }

    public function create($fields)
    {
        $set_fields = '';

        // setta le variabili da inserire
        while (list($field, $value) = each($fields)) {
            if ($value != '' and $field != 'pk') {
                $set_fields .= "$field ='" . mysqli_escape_string($this->connection, $value) . "', ";
            }
        }

        // rimuove l'ultima virgola
        $set_fields = substr($set_fields, 0, -2);

        // query
        $query = "INSERT INTO " . $this->table_name . " SET " . $set_fields . "";
        mysqli_query($this->connection, $query);

        //$_SESSION['message'] = $query;

        if ((mysqli_error($this->connection))) {
            //$_SESSION["error"] = "Errore: L'orario inserito risulta già presente per l'attività selezionata";
            $_SESSION["error"] = mysqli_error($this->connection);
        }
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
        mysqli_query($this->connection, $query);

        if ((mysqli_error($this->connection))) {
            //$_SESSION["error"] = "Errore: L'orario inserito risulta già presente per l'attività selezionata";
            print_r(mysqli_error($this->connection));
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

    private function format_delete_query($where)
    {
        $query = "DELETE FROM " . $this->table_name . "";

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
