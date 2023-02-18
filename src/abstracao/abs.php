<?php
    namespace MysqlQuery;
    abstract class abs{
        abstract protected function createTable($tableName, $arr = array(), $type = array());
        abstract protected function useDB($db);
        abstract protected function insertDB($table, $itens = array(), $values = array());
        abstract protected function getCout($table, $itens = array(), $values = array());
        abstract protected function drodDB($database);
        abstract protected function GetAllElements($tabela);
        abstract protected function GetUniqElements($table, $coll = array(), $values = array());
        abstract protected function DropTable($Table);
        abstract protected function deleteUniqElement($table,  $colunas, $values);
        abstract protected function alterElement($table, $colunas, $valor, $condicion);
    }
?>