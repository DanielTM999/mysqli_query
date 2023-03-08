<?Php
    namespace MysqlQuery;

    use mysqli;
    use PdoMasterFi;

    include "./abstracao/abs.php";

    //main CLass
    class Master extends abs{

        private $banco;
        private $host = "";
        private $user = "";
        private $password = "";

        function __construct($host, $user, $password){
             $this->host = $host;
             $this->user = $user;
             $this->password = $password;
        }

        public  function conexao(){

            $host = $this->host;
            $user = $this->user;
            $password = $this->password;
            $banco = $this->banco;

            try {
                $db = mysqli_connect($host, $user, $password, $banco);
                return $db;
            } catch (\Throwable $th) {
                echo $th->getMessage();
                
            }
        }

        public function createDB($database){
            $sql = "CREATE DATABASE IF NOT EXISTS $database";
            $db = mysqli_connect($this->host, $this->user, $this->password);
            $create = mysqli_query($db, $sql);
            
            if($create){
                return true;
            }else{
                return false;
            }
        }

        public function useDB($database){
            $this->banco = $database;
        }

        public function createTable($tableName, $arr = array(), $type = array()){
            $pste = "";
            foreach($type as $tp){
                if($tp != "varchar" && $tp != "int"){
                    return false;
                }
            }

            foreach(array_combine($arr, $type) as $kay => $t){
                $t = strtoupper($t);
                if($t == "INT"){
                    $pste .= "$kay $t NOT NULL,"; 
                }else if($t == "VARCHAR"){
                    $pste .= "$kay $t(255) NOT NULL,";
                }
            }
            $sql = "CREATE TABLE IF NOT EXISTS $tableName(
                id$tableName  INT NOT NULL AUTO_INCREMENT,
                $pste
                PRIMARY KEY (`id$tableName`)
            )";
            try {
                $act = mysqli_query($this->conexao(), $sql);
                if($act){
                    return true;
                }else{
                    return false;
                }
            } catch (\Throwable $th) {
                return $th;
            }
        }

        public function ShowInfo(){
            return ["host"=>$this->host, "user"=>$this->user, "password"=>$this->password, "database"=>$this->banco];
        }

        public function insertDB($table, $itens = array(), $values = array()){
            $banco = $this->banco;
            $pste_itens = "";
            $pste_values = "";
            foreach(array_combine($itens, $values) as $id => $param){
                if(is_bool($param)){
                    if($param){
                        $param = "true";
                    }else{
                        $param = "false";
                    }
                }
                $pste_itens .= "$id,";
                $param = mysqli_real_escape_string($this->conexao(), $param);
                if(strtolower($param) == "false" || strtolower($param) == "true"){
                    $pste_values .= "$param,";
                }else{
                    $pste_values .= "'$param',";
                }
            }  
            
            $itens = substr($pste_itens, 0, strlen($pste_itens)-1);
            $insert = substr($pste_values, 0, strlen($pste_values)-1);
            $sql = "INSERT INTO $banco.$table($itens) VALUES ($insert)";
            echo $sql;
            try {
                $act = mysqli_query($this->conexao(), $sql);

                if($act){
                    return true;
                }else{
                    return false;
                }
            } catch (\Throwable $th) {
                return false;
            }
        }

        public function getCout($table, $itens = array(), $values = array()){
            $banco = $this->banco;
            $pste = "";
            foreach(array_combine($itens, $values) as $key => $key1){
                $key1 = mysqli_real_escape_string($this->conexao(), $key1);
                $pste .= "$key='$key1' OR ";
            }
            $query = substr($pste, 0, strlen($pste)-4);

            $sql = "SELECT * FROM $banco.$table WHERE $query";

            try {
                $act = mysqli_query($this->conexao(), $sql);
                if($act){
                    $row = mysqli_num_rows($act);
                    
                    return $row;
                }else{
                    return false;
                }
            } catch (\Throwable $th) {
                return false;
            }
        }

        public function drodDB($database){
            $sql = "DROP DATABASE $database";

            try {
                $act = mysqli_query($this->conexao(), $sql);
                if($act){
                    return true;
                }else{
                    return false;
                }
            } catch (\Throwable $th) {
                return $th;
            }
        }

        public function GetAllElements($tabela){
            $banco = $this->banco;
            $sql = "SELECT * FROM $banco.$tabela";

            try {
                $act = mysqli_query($this->conexao(), $sql);
                if($act){
                    return $act;
                }else{
                    return false;
                }
            } catch (\Throwable $th) {
                return $th;
            }
        }

        public function GetUniqElements($tabela, $collunas = array(), $values = array(), $all = ['*']){
            $banco = $this->banco;

            $select = "";
            foreach($all as $key){
                $select .= "$key,";
            }
            $select = substr($select, 0, strlen($select) - 1);

            if(strpos($select, "*") !== false){
                $select = "*";
            }

            $pste = "";
            foreach(array_combine($collunas, $values) as $colluns => $valor){
                $valor = mysqli_real_escape_string($this->conexao(), $valor);
                $pste .= "$colluns='$valor' or ";
            }
            $pste = substr($pste, 0, strlen($pste) - 4);

            $sql = "SELECT $select FROM $banco.$tabela WHERE $pste";
            
            try {
                $act = mysqli_query($this->conexao(), $sql);
                if($act){
                    return mysqli_fetch_assoc($act);
                }else{
                    return false;
                }
            } catch (\Throwable $th) {
                return $th;
            }
        }

        public function DropTable($table){
            $banco = $this->banco;
            $sql = "DROP TABLE $banco.$table";

            try {
                $act = mysqli_query($this->conexao(), $sql);
                if($act){
                    return true;
                }else{
                    return false;
                }
            } catch (\Throwable $th) {
                return $th;
            }
        }

        public function deleteUniqElement($table, $colunas, $values){
            $banco = $this->banco;
            $pste = "";

            foreach(array_combine($colunas, $values) as $coll => $valores){
                $valores = mysqli_real_escape_string($this->conexao(), $valores);
                $pste .= "$coll='$valores' OR ";
            }

            $pste = substr($pste, 0, strlen($pste) - 4);

            $sql = "DELETE FROM `$banco`.`$table` WHERE ($pste)";

            try {
                $act = mysqli_query($this->conexao(), $sql);
                if($act){
                    return true;
                }else{
                    return false;
                }
            } catch (\Throwable $th) {
                return $th;
            } 
        }

        public function alterElement($table, $colunas, $valor, $condicion){
            $banco = $this->banco;

            $pste = "";
            foreach(array_combine($colunas, $valor) as $collun => $values){
                $values = mysqli_real_escape_string($this->conexao(), $values);
                $pste .= "$collun='$values',";
            }
            $pste = substr($pste, 0, strlen($pste) - 1);

            $setcon = $condicion[0];
            $setcon2 = $condicion[1];

            $sql = "UPDATE $banco.$table SET $pste WHERE $setcon='$setcon2'";

            try {
                $act = mysqli_query($this->conexao(), $sql);
                if($act){
                    return true;
                }else{
                    return false;
                }
            } catch (\Throwable $th) {
                return $th;
            }finally{
                $com = $this->conexao();
            }
        }

    }

    class PdoMaster extends PdoMasterFi{
        private $host;
        private $pass;
        private $user;
        private $typeDB;

        function __construct($host, $pass, $typeDB, $user){
          $this->host = $host;
          $this->pass = $pass;
          $this->typeDB = $typeDB;
          $this->user = $user;   
          parent::__construct($this->host, $this->pass,$this->typeDB, $this->user);
        }

        public function connection_statusPDO(){
            if(parent::conexao()){
                echo 'sucesso';
            }else if(parent::conexao() == null){
                echo 'erro connerxão == '. parent::conexao();
            }else{
                echo 'fatal erro';
            }
        }

    }
?>
