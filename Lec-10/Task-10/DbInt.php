<?php


interface DbInt
{
    public function select($table, $cols);
    public function insert($table, $insertedData);
    public function update($table, array $newValues);
    public function delete($table);
}
