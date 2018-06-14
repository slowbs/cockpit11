<?php

include "config.ini.php";

class db {

    // สร้าง properties ต่าง ๆ
    /*var $host;
    var $username;
    var $pass;
    var $db_name;
    var $charset;
    var $sql;
*/
    // เมื่อทำการ new object ก็กำหนดค่าให้ properties
    /*function __construct() {
        $this->host ='192.168.1.3';
        $this->username = 'sa';
        $this->pass ='sa';
        $this->db_name ='hosxp_pcu';
        $this->charset = 'utf-8';
    }*/
    
    // สร้าง function ในการเชื่อมต่อฐานข้อมูล
    function connect() {
        $conn = mysql_connect($hostname,  $this->username,  $this->pass);

        // ถ้าเชื่อมต่อได้
        if ($conn) {
            // เลือกฐานข้อมูล
            mysql_select_db($dbname);

            // กำหนดการเข้ารหัสตัวอักษร
            mysql_query('SET NAMES ' . $this->charset);
        }
        return $conn;
    }

    function findAll($tableName) {
        $conn = $this->connect();

        if (!empty($conn)) {
            $this->sql = 'SELECT * FROM ' . $tableName;
            return $this;
        }
        return null;
    }

    function execute() {
        $conn = $this->connect();

        if (!empty($conn)) {
            return mysql_query($this->sql);
        }
        return null;
    }

    function findByPk($table, $column, $value) {
        $this->sql = "SELECT * FROM $table WHERE $column = $value";
        return $this;
    }

    function executeRow() {
        $conn = $this->connect();

        if (!empty($conn)) {
            $rs = mysql_query($this->sql);

            if (!empty($rs)) {
                $row = mysql_fetch_array($rs);
                return $row;
            }
        }
        return null;
    }

    function findByAttributes($table, $attributes) {
        $this->sql = "SELECT * FROM $table WHERE";
        $count = 0;

        foreach ($attributes as $k => $v) {
            if ($count == 0) {
                $this->sql .= " $k '$v'";
            } else {
                $this->sql .= " AND $k '$v'";
            }

            $count++;
        }

        return $this;
    }

    function in($table, $field, $value) {
        $_value = "";
        $count = 0;

        foreach ($value as $v) {
            $_value .= "$v";

            // add comma ,
            if (count($value) != $count + 1) {
                $_value .= ",";
            }

            $count++;
        }

        $this->sql = "SELECT * FROM $table WHERE $field IN ($_value)";
        return $this;
    }

    function between($table, $field, $from, $to) {
        $this->sql = "SELECT * FROM $table WHERE $field BETWEEN $from AND $to";
        return $this;
    }

    function compare($table, $field, $value) {
        $this->sql = "SELECT * FROM $table WHERE $field $value";
        return $this;
    }

    function conditions($table, $condition) {
        $this->sql = "SELECT * FROM $table WHERE $condition";
        return $this;
    }

    function order_by($table, $order) {
        $this->sql = "SELECT * FROM $table ORDER BY $order";
        return $this;
    }

    function insert($table, $data) {
        $field = "";
        $val = "";
        $i = 0;

        foreach ($data as $k => $v) {
            $field .= $k;
            $val .= "'$v'";

            if ($i < count($data) - 1) {
                $field .= ',';
                $val .= ',';
            }
            $i++;
        }
        $this->sql = "INSERT INTO $table($field) VALUES($val)";
        return mysql_query($this->sql);
    }

    function delete($table, $field, $value) {
        $this->sql = "DELETE FROM $table WHERE $field = $value";
        return mysql_query($this->sql);
    }

    function update($table, $data, $field, $value) {
        $rows = "";
        $i = 0;

        foreach ($data as $k => $v) {
            // ถ้าไม่ใช่รหัส pk
            if ($k != $field) {
                // update ทีละแถว
                $rows .= "$k = '$v'";

                // ถ้าไม่ใช่ค่าสุดท้ายให้ต่ออักษร , เข้าไปอีก
                // - 2 เพราะตัด pk ออกด้วย
                if ($i < count($data) - 1) {    
                    $rows .= ',';
                }
                $i++;
            }
        }
        
        // ประมวลผลคำสั่ง SQL
        $this->sql = "UPDATE $table SET $rows WHERE $field = $value";
        return mysql_query($this->sql);
    }

}

?>
