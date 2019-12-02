<?php
/**
 * Created by PhpStorm.
 * User: klin
 * Date: 2019-12-01
 * Time: 10:08 PM
 */

require "../../config.php";
require "../../common.php";

$conn = new PDO("mysql:dbname=$dbname;host=$host", $username, $password, $options);

function create($table) {

}

function readSingle($table, $where, $where_value) {
    try  {
        global $conn;
        $sql = "SELECT * FROM $table WHERE $where = $where_value";
        $statement = $conn->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll();
        return $result;
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}

function readAll($table) {
    try  {
        global $conn;
        $sql = "SELECT * FROM $table";
        $statement = $conn->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll();
        return $result;
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}

function update($table) {

}

function delete($table) {

}