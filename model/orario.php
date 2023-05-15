<?php
interface i_orario{
    public function __construct($new_schedule);
    public function create();
    public function get();
    public function delete();
}

class orario implements i_orario
{
    private $attivita;
    private $data_attivita;
    private $ora_inizio;
    private $ora_termine;
    private $chiusura_richieste;
    private $stato;

    public function __construct($new_schedule)
    {
        foreach ($new_schedule as $field => $value) {
            $this->$field = $new_schedule["$field"];
        }
        self::print_log($this);
    }

    public function create(){
        require_once $_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/access_layer/DAOFactory.php";

        $this->chiusura_partecipazione = 0;
        $this->stato_conclusione = 0;

        $dao = DAOFactory::get_DAO($this);

        echo'<pre>'; print_r($this); echo'</pre>';

        //crea l'array per il DAO
        $fields = get_object_vars($this);

        $dao->create($fields);

    }

    public function get(){
        require_once $_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/access_layer/DAOFactory.php";

        $dao = DAOFactory::get_DAO($this);

        $fields = get_object_vars($this);

        $result = $dao->read_by_field($fields);

        if($result->num_rows == 0){
            return false;
        }

        else{
            while($row = $result->fetch_assoc()){
                $schedules[] = $row;
            }
            return json_encode($schedules);
        }
    }

    public function close(){
        require_once $_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/access_layer/DAOFactory.php";

        $dao = DAOFactory::get_DAO($this);

        $pk = get_object_vars($this);

        $this->chiusura_richieste = 1;

        $fields['chiusura_richieste'] = $this->chiusura_richieste;

        $dao->update($pk, $fields);
        
    }

    public function open(){
        require_once $_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/access_layer/DAOFactory.php";

        $dao = DAOFactory::get_DAO($this);

        $pk = get_object_vars($this);

        $this->chiusura_richieste = '0';

        $fields['chiusura_richieste'] = $this->chiusura_richieste;

        $dao->update($pk, $fields);
        
    }

    public function complete(){
        require_once $_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/access_layer/DAOFactory.php";

        $dao = DAOFactory::get_DAO($this);

        $pk = get_object_vars($this);

        $this->stato = 'conclusa';

        $fields['stato'] = $this->stato;

        $dao->update($pk, $fields);
        
    }

    public function delete(){
        require_once $_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/access_layer/DAOFactory.php";

        $dao = DAOFactory::get_DAO($this);

        $pk = get_object_vars($this);

        $dao->delete($pk);
    }

    private static function print_log($log){
        echo'<pre>'; print_r($log); echo'</pre>';
    }


}
?>