<?php 

class richiesta{
    private $partecipante;
    private $attivita;
    private $data_attivita;
    private $ora_inizio;
    private $ora_termine;
    private $accettazione;
    private $presenza;

    public function __construct($new_request)
    {
        foreach ($new_request as $field => $value) {
            $this->$field = $new_request["$field"];
        }
        self::print_log($this);
    }

    public function accept(){
        require_once $_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/access_layer/DAOFactory.php";

        $pk = get_object_vars($this);

        $dao = DAOFactory::get_DAO($this);

        $this->accettazione = 1;

        $fields['accettazione'] = $this->accettazione;

        $dao->update($pk, $fields);
    }

    public function send(){
        require_once $_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/access_layer/DAOFactory.php";

        $this->accettazione = 0;
        $this->presenza = 0;

        $dao = DAOFactory::get_DAO($this);

        $fields = get_object_vars($this);

        $dao->create($fields);
    }
    
    public function get(){
        require_once $_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/access_layer/DAOFactory.php";

        $dao = DAOFactory::get_DAO($this);

        $fields = get_object_vars($this);

        $result = $dao->read_by_field($fields);

        if(!$result){
            return false;
        }
        else{
            while($row = $result->fetch_assoc()){
                $requests[] = $row;
            }
            return json_encode($requests);
        }
    }

    public function refuse(){
        require_once $_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/access_layer/DAOFactory.php";

        $dao = DAOFactory::get_DAO($this);

        $fields = get_object_vars($this);

        $dao->delete($fields);
    }

    public function set_attendance(){
        require_once $_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/access_layer/DAOFactory.php";

        $pk = get_object_vars($this);

        $dao = DAOFactory::get_DAO($this);

        $this->presenza = 1;

        $fields['presenza'] = $this->presenza;

        $dao->update($pk,$fields);
    }


    public static function print_log($log){
        echo'<pre>'; print_r($log); echo'</pre>';
    }
    

}
?>