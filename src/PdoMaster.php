<?php
    class PdoMasterFi{
        private $host;
        private $pass;
        private $pdodb;
        private $typeDB;

        function __construct($host, $pass, $typeDB){
          $this->host = $host;
          $this->pass = $pass;
          $this->typeDB = $typeDB;   
        }

        public function showInfo(){
            return $this->typeDB;
        }

        public function conexao(){
            try{
                if($this->typeDB == "mysql"){
                    $conn = new PDO("mysql:dbname=;host=localhost", 'root', '');
                    return $conn;
                }else{
                    return $conn = null;
                }
            }catch(PDOException $e){
                echo $e->getMessage();
            }catch(Exception $e){
                echo $e->getMessage();
            }
        }
    }
?>