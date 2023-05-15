<?php 
    interface i_itinerario{
        public function get();
        public function __construct($new_root);
        public function delete();
        public function add_lap($new_lap);
        public function remove_lap($lap);
    }

    class Tappa{
        public $nome_luogo;
        public $descrizione;

        public function __construct($new_lap){
            $this->nome_luogo = $new_lap['nome_luogo'];
            $this->descrizione = $new_lap['descrizione'];
        }
    }

    class itinerario implements i_itinerario{
        private $attivita;

        public function __construct($new_root){
            $this->attivita = $new_root;
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
                    $laps[] = $row;
                }
                return json_encode($laps);
            }
            
        }

        public function delete(){
            require_once $_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/access_layer/DAOFactory.php";

            $dao = DAOFactory::get_DAO($this);

            $fields = get_object_vars($this);

            print_r($fields);

            $dao->delete($fields);
        }

        public function add_lap($new_lap){
            require_once $_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/access_layer/DAOFactory.php";

            $lap = new Tappa($new_lap);

            $fields = get_object_vars($this);
            $fields['nome_luogo'] = $lap->nome_luogo;
            $fields['descrizione'] = $lap->descrizione;

            $dao = DAOFactory::get_DAO($this);

            $dao->create($fields);
        }

        public function set_lap($lap){
            require_once $_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/access_layer/DAOFactory.php";

            $lap = new Tappa($lap);

            $fields = get_object_vars($this);
            $fields['nome_luogo'] = $lap->nome_luogo;
            $fields['descrizione'] = $lap->descrizione;

            $pk['attivita'] = $fields['attivita'];
            $pk['nome_luogo'] = $_SESSION['modifica_tappa'][0];
            unset($fields['attivita']);

            self::print_log($fields);
            self::print_log($pk);

            $dao = DAOFactory::get_DAO($this);

            $dao->update($pk ,$fields);
        }

        public function remove_lap($lap){
            require_once $_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/access_layer/DAOFactory.php";
            
            $deleted_lap = new Tappa($lap);

            $fields = get_object_vars($this);
            $fields['nome_luogo'] = $deleted_lap->nome_luogo;
            $fields['descrizione'] = $deleted_lap->descrizione;

            $dao = DAOFactory::get_DAO($this);

            $dao->delete($fields);
        }   

        private static function print_log($log){
            echo'<pre>'; print_r($log); echo'</pre>';
        }
    }
