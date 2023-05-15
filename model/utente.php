<?php
    interface iutente{
        public function create_user($user);
        public function get_auth($email, $password);
        public function get_email($email);
        public function get_password($id, $password);
        public function get_user($id);
        public function set_user($id, $user);
        public function delete_user($id);
    }
    
    class utente implements iutente {
        private $id;
        private $email;
        private $psw;
        private $nome;
        private $cognome;
        private $telefono;  
        private $dataNascita;
        private $citta;
        private $nazione;
        private $sesso;
        private $imgProfilo;
        private $segnalazioni;
        private $voti_positivi;
        private $voti_negativi;
         
        public function get_auth($email, $password){
            require_once $_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/access_layer/DAOFactory.php";

            $this->email = $email;
            $this->psw = $password;

            // crea utenteDAO
            $dao = DAOFactory::get_DAO($this);

            // crea l'array per il DAO
            $fields = get_object_vars($this);

            // esegue la query
            $result = $dao->read_by_field($fields);

            if(!$row = $result->fetch_assoc()){
                return false;
            }

            else{
                unset($row['psw']);
                return json_encode($row);
            }

        }
        
        public function create_user($user){
            require_once $_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/access_layer/DAOFactory.php";

            //Assegna gli attributi
            foreach ($user as $field => $value){
                $this->$field = $user["$field"];
            }

            // crea l'array per il DAO
            $user = get_object_vars($this);

            // crea utenteDAO
            $dao = DAOFactory::get_DAO($this);
            $dao->create($user);
        }

        public function get_email($email){
            require_once $_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/access_layer/DAOFactory.php";

            $this->email = $email;   

            // crea utenteDAO
            $dao = DAOFactory::get_DAO($this);

            // crea l'array per il DAO
            $fields = get_object_vars($this);     

          

            //esegue la query
            $result = $dao->read_by_field($fields);

            if(!$row = $result->fetch_assoc()){
                return false;
            }

            else{
                unset($row['psw']);
                return json_encode($row);
            }
        }

        public function get_password($id, $password){
            require_once $_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/access_layer/DAOFactory.php";

            $this->id = $id;
            $this->psw = $password;

            // crea utenteDAO
            $dao = DAOFactory::get_DAO($this);

            // crea l'array per il DAO
            $fields = get_object_vars($this);

            //esegue la query
            $result = $dao->read_by_field($fields);

            if(!$row = $result->fetch_assoc()){
                return false;
            }

            else{
                unset($row['psw']);
                return json_encode($row);
            }
        }

        public function set_user($id, $user){
            require_once $_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/access_layer/DAOFactory.php";
            $this->id = $id;

            //Assegna gli attributi
            foreach ($user as $field => $value){
                $this->$field = $user["$field"];
            }

            // crea utenteDAO
            $dao = DAOFactory::get_DAO($this);

            // crea l'array per il DAO
            $user = get_object_vars($this);

            print_r($user);
            //rimuovi la chiave primaria, se no son danni!!
            array_shift($user);

            //esegui la query
            $dao->update($this->id, $user);
        }


        public function delete_user($id){
            require_once $_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/access_layer/DAOFactory.php";
            
            $this->id = $id;

            // crea utenteDAO
            $dao = DAOFactory::get_DAO($this);

            //esegui la query
            $dao->delete($this->id);
        }

        public function get_user($id){
            require_once $_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/access_layer/DAOFactory.php";
            $this->id = $id;
            
            //crea utenteDAO
            $dao = DAOFactory::get_DAO($this);

            //esegui la query
            $result = $dao->read_by_pk($this->id);

            if(!$row = $result->fetch_assoc()){
                return false;
            }

            else{
                unset($row['psw']);
                return json_encode($row);
            }
        }

        public static function print_obj($obj){
            echo'<pre>';print_r($obj);echo'</pre>';
        }
    }
?>