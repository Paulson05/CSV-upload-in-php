<?php
namespace Phppot;

use Phppot\DataSource;

class UserModel
{

    private $conn;

    function __construct()
    {
        require_once 'DataSource.php';
        $this->conn = new DataSource();
    }

    function getAllUser()
    {
        $sqlSelect = "SELECT * FROM users";
        $result = $this->conn->select($sqlSelect);
        return $result;
    }

    function readUserRecords()
    {
        $fileName = $_FILES["file"]["tmp_name"];
        if ($_FILES["file"]["size"] > 0) {
            $file = fopen($fileName, "r");
            $importCount = 0;
            while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
                if (! empty($column) && is_array($column)) {
                    if ($this->hasEmptyRow($column)) {
                        continue;
                    }
                    if (isset($column[0], $column[1], $column[2], $column[3],$column[4])) {
                        $symbol = $column[0];
                        $isoCode = $column[1];
                        $isonumericCode = $column[2];
                        $commonName = $column[2];
                        $officialName = $column[4];
                        $insertId = $this->insertUser($symbol,  $isoCode,  $isonumericCode,$commonName, $officialName);
                        if (! empty($insertId)) {
                            $output["type"] = "success";
                            $output["message"] = "Import completed.";
                            $importCount ++;
                        }
                    }
                } else {
                    $output["type"] = "error";
                    $output["message"] = "Problem in importing data.";
                }
            }
            if ($importCount == 0) {
                $output["type"] = "error";
                $output["message"] = "Duplicate data found.";
            }
            return $output;
        }
    }

    function hasEmptyRow(array $column)
    {
        $columnCount = count($column);
        $isEmpty = true;
        for ($i = 0; $i < $columnCount; $i ++) {
            if (! empty($column[$i]) || $column[$i] !== '') {
                $isEmpty = false;
            }
        }
        return $isEmpty;
    }

    function insertUser($symbol,  $isoCode,  $isonumericCode,$commonName, $officialName)
    {
        $sql = "SELECT isoCode FROM users WHERE isoCode = ?";
        $paramType = "s";
        $paramArray = array(
            $isoCode
        );
        $result = $this->conn->select($sql, $paramType, $paramArray);
        $insertId = 0;
        if (empty($result)) {
            
            $sql = "INSERT into users (symbol,isoCode,isonumericCode,commonName,officialName)
                       values (?,?,?,?,?)";
            $paramType = "sssss";
            $paramArray = array(
               
                $symbol,
                $isoCode,
                $isonumericCode,
                $commonName,
                $officialName,
            );
            $insertId = $this->conn->insert($sql, $paramType, $paramArray);
        }
        return $insertId;
    }
}
?>