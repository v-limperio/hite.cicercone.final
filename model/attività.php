<?php 
    interface i_attività{
        public function create_activity($activity_data);
        public function get_activity_by_id($id);
        public function get_activity_by_cicerone($activity_data);
        public function set_activity($id, $activity_data);
        public function delete_activity($id);
        public function set_meeting_point($id, $meeting_point);
    }
    class attività implements i_attività{
        private $id;
        private $titolo;
        private $cicerone;
        private $tipologia;
        private $descrizione;
        private $incontro_lat;
        private $incontro_lng;
        private $indirizzo_incontro;
        private $lingua_parlata;
        private $img_attivita;
        private $citta;
        private $votipositivi;
        private $votinegativi;

        public function create_activity($activity_data){
            require_once $_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/access_layer/DAOFactory.php";

            $this->votipositivi = 0;
            $this->votinegativi = 0;

            //assegna gli attributi
            foreach($activity_data as $field => $value){
                if($value != ''){
                    $this->$field = $activity_data["$field"];
                }
            }
            //crea l'array per il DAO
            $activity = get_object_vars($this);

            echo"ACTIVITIY";
            self::print_log($activity);

            //crea attivitàDAO
            $dao = DAOFactory::get_DAO($this);

            // Memorizza l'attività nel database
            $dao->create($activity);
        }

        public function get($activity){
            require_once $_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/access_layer/DAOFactory.php";

            foreach($activity as $field => $value){

                if(isset($activity["$field"])){
                    $this->$field = $activity["$field"];
                }

            }

            $dao = DAOFactory::get_DAO($this);

            $field = get_object_vars($this);

            $result = $dao->read_by_field($field);

            if($result->num_rows == 0){
                return false;
            }
            else{
                while($row = $result->fetch_assoc()){
                    $activities[] = $row;
                }
                
                return json_encode($activities);
            }
        }
        
        public function get_activity_by_id($id){
            require_once $_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/access_layer/DAOFactory.php";
            //assegna gli attributi
            $this->id = $id;
            //crea AttivitàDAO
            $dao = DAOFactory::get_DAO($this);

            $fields = get_object_vars($this);
            //Ricerca l'attività tramite il cicerone
            $result = $dao->read_by_field($fields);
            if($result->num_rows == 0){
                return false;
            }
            else{
                $row = $result->fetch_assoc();
                return json_encode($row);
            }
        }
        public function get_activity_by_cicerone($activity_data){
            require_once $_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/access_layer/DAOFactory.php";
            self::print_log($activity_data);

            //assegna gli attributi
            $this->cicerone = $activity_data["cicerone"];


            //crea AttivitàDAO
            $dao = DAOFactory::get_DAO($this);
            $field = get_object_vars($this);
            
            
            //ricerca le attività del cicerone
            $result = $dao->read_by_field($field);
            
            if($result->num_rows == 0){
                return false;
            }
            else{
                while($row = $result->fetch_assoc()){
                    $activities[] = $row;
                }
                
                return json_encode($activities);
            }
        }
        public function set_activity($id, $activity){
            require_once $_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/access_layer/DAOFactory.php";
            //assegna gli attributi
            $this->id = $id;
            foreach($activity as $field => $value){
                if($value != ''){
                    $this->$field = $activity["$field"];
                }
            }
            //crea AttivitàDAO
            $dao = DAOFactory::get_DAO($this);
            //crea l'array per il DAO
            $activity = get_object_vars($this);
            //rimuovi la chiave primaria, se no son danni!!
            array_shift($activity);
            //esegui la query 
            $dao->update($this->id, $activity);
        }
        public function delete_activity($id){
            require_once $_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/access_layer/DAOFactory.php";
            
            //assegna gli attributi
            $this->id = $id;
            //crea attivitàDAO
            $dao = DAOFactory::get_DAO($this);
            //esegui la query 
            $dao->delete($this->id);
        }
        public function set_meeting_point($id, $meeting_point){
            require_once $_SERVER['DOCUMENT_ROOT']."/hite.cicerone.io/access_layer/DAOFactory.php";

            //assegna gli attributi 
            $this->id = $id;

            //crea attivitàDAO
            $dao = DAOFactory::get_DAO($this);
            
            //esegui la query
            $dao->update($this->id, $meeting_point);
        }


        private static function print_log($log){
            echo'<pre>'; print_r($log); echo'</pre>';
        }

    }
  