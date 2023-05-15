<?php
interface i_itinerarioDAO
{
    public function create($fields);
    public function read_by_pk($pk);
    public function read_by_field($fields);
    public function update($pk, $fields);
    public function delete($pk);
}

require_once "DAO.php";
class itinerarioDAO extends DAO implements i_itinerarioDAO
{
    public function __construct($connection)
    {
        $this->table_name = "itinerario";
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

        if (!mysqli_query($this->connection, $query)) {
            $_SESSION['error'] = mysqli_error($this->connection);
            echo mysqli_error($this->connection);
        }
    }


    public function delete($pk)
    {
        if (count($pk) == 1) {
            $this->primary_key = "attivita";
            $primary_key = $pk['attivita'];

            $query = "DELETE FROM " . $this->table_name . " WHERE " . $this->primary_key . " = ('$primary_key')";
            print_r($query);
        } else {
            $query = "DELETE FROM " . $this->table_name . "";

            foreach ($pk as $field => $value) {
                if ($value != '' and $field == 'attivita') {
                    $query .= " WHERE  $field = " . " '$value'";
                }
                if ($value != '' and $field != 'attivita') {
                    $query .= " AND  $field = " . " '$value'";
                }
            }

            print_r($query);
        }


        if (!mysqli_query($this->connection, $query)) {
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
