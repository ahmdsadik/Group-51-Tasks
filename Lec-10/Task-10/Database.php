<?php

require_once "DbInt.php";

class Database implements DbInt
{
    public $con;
    public $query_res;
    public $query;

    public function __construct()
    {
        $this->con = mysqli_connect('localhost', 'root', '', 'group-51-test-web');
    }

    public function select($table, $cols)
    {
        if (is_array($cols)) {
            $cols = implode(',', $cols);
        }
        $this->query = "select $cols from $table ";
        return $this;
    }

    public function where($col, $op, $value)
    {
        $this->query .= " where $col $op '$value'";
        return $this;
    }

    public function and($col, $op, $valu)
    {
        $this->query .= " and $col $op '$valu'";
        return $this;
    }
    public function allData()
    {
        $this->query_res = mysqli_query($this->con, $this->query);
        return mysqli_fetch_all($this->query_res, MYSQLI_ASSOC);
    }

    public function insert($table, $insertedData)
    {
        $cols = implode(',', array_keys($insertedData));
        $values = "'" . implode("','", array_values($insertedData)) . "'";
        $this->query = "insert into $table ( $cols ) values ( $values )";

        return $this;
    }
    public function excut()
    {
        $this->query_res = mysqli_query($this->con, $this->query);
    }
    public function update($table,  array $newValues)
    {
        $this->query = "update users set ";
        foreach ($newValues as $column => $val) {
            $this->query .= "$column = '$val' ,";
        }
        $this->query = rtrim($this->query, ',');
        return $this;
    }

    public function delete($table)
    {
        $this->query = "delete from $table";
        return $this;
    }
}
