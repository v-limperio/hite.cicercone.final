<?php 
class valutazione{
    private $utente;
    private $attivita;
    private $voto;
    private $recensione;

    public function __construct($new_review)
    {
        foreach ($new_review as $field => $value) {
            $this->$field = $new_review["$field"];
        }
        self::print_log($this);
    }

    public function create(){
        require_once $_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/access_layer/DAOFactory.php";

        $dao = DAOFactory::get_DAO($this);

        //crea l'array per il DAO
        $fields = get_object_vars($this);

        $dao->create($fields);
    }

    public function get(){
        require_once $_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/access_layer/DAOFactory.php";

        $dao = DAOFactory::get_DAO($this);

        //crea l'array per il DAO
        $fields = get_object_vars($this);

        $result = $dao->read_by_field($fields);

        if($result->num_rows == 0){
            return false;
        }

        else{
            while($row = $result->fetch_assoc()){
                $reviews[] = $row;
            }
            return json_encode($reviews);
        }
    }

    public function set(){
        require_once $_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/access_layer/DAOFactory.php";

        $dao = DAOFactory::get_DAO($this);

        //crea l'array per il DAO
        $fields['recensione'] = $this->recensione;
        $fields['voto'] = $this->voto;

        $pk['utente'] = $this->utente;
        $pk['attivita'] = $this->attivita;

        self::print_log($pk);
        self::print_log($fields);

        $dao->update($pk, $fields);
    }

    public function delete(){
        require_once $_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/access_layer/DAOFactory.php";

        $dao = DAOFactory::get_DAO($this);

        $pk['utente'] = $this->utente;
        $pk['attivita'] = $this->attivita;

        $fields['voto'] = '-1';
        $fields['recensione'] = 'NULL';

        self::print_log($pk);

        $dao->update($pk, $fields);
    }

    public static function print_log($log){
        echo'<pre>'; print_r($log); echo'</pre>';
    }
}
?>