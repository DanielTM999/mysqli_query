<?php
    class PdoMasterFi{
        private $host;
        private $pass;
        private $pdodb;
        private $user;
        private $typeDB;

        function __construct($host, $pass, $typeDB, $user){
          $this->host = $host;
          $this->pass = $pass;
          $this->typeDB = $typeDB; 
          $this->user = $user;  
        }

        public function showInfo(){
            $res = [$this->typeDB, $this->host, $this->pass, $this->user, $this->pdodb];
            return $res;

        }

        public function conexao(){
            $host = $this->host;
            $user = $this->user;
            $password = $this->pass;
            $banco = $this->pdodb;

            try{
                if($this->typeDB == "mysql"){
                    $conn = new PDO("mysql:dbname=$banco;host=$host", $user, $password);
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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

        public function useDB($database){
            $this->pdodb = $database;
        }

        public function CreateDB($database){
            $sql = "CREATE DATABASE IF NOT EXISTS $database";

            try {
                $pdo = $this->conexao();
                $pste = $pdo->prepare($sql);
                $auth = $pste->execute();

                if($auth){
                    $this->useDB($database);
                    return true;
                }else{
                    return false;
                }
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    }
?>