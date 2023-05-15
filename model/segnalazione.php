<?php 
class segnalazione{
    private $segnalatore;
    private $segnalato;
    private $causa;
    private $descrizione_causa;


    public function __construct($new_report)
    {
        foreach ($new_report as $field => $value) {
            $this->$field = $new_report["$field"];
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
    
    public static function print_log($log){
        echo'<pre>'; print_r($log); echo'</pre>';
    }
}

?>