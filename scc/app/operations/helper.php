<?php
/**
 * Created by PhpStorm.
 * User: klin
 * Date: 2019-12-02
 * Time: 7:41 PM
 */

require "../../config.php";

try {
    $conn = new PDO("mysql:dbname=$dbname;host=$host", $username, $password, $options);
} catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
}

function describe($table) {
    try{
        global $conn;
        $sql = "describe $table";
        $statement = $conn->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}