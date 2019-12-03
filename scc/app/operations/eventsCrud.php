<?php

require "../../config.php";
require "../../common.php";

try {
    $conn = new PDO("mysql:dbname=$dbname;host=$host", $username, $password, $options);
} catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
}

/**
 * @param $table table name
 * @param $inputs array_keys of inputs from a form
 */
function create($table, $inputs) {
    try  {
        global $conn;
        unset($inputs['csrf']);
        unset($inputs['submit']);
        $data = $inputs;
        $set_data = "";
        for ($i = 0; $i < sizeof($inputs); $i++) {
            $set_data .= array_keys($inputs)[$i] . " = " . "\"" . $data[array_keys($inputs)[$i]] . "\"";
            if ($i < sizeof($inputs) - 1) {
                $set_data .= ", ";
            }
        }
        $sql = sprintf(
            "INSERT INTO %s (%s) values (%s)",
            "$table",
            implode(", ", array_keys($inputs)),
            ":" . implode(", :", array_keys($inputs))
        );

        $statement = $conn->prepare($sql);
        $statement->execute($inputs);
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}

/**
 * @param $table table name
 * @param $where row target
 * @param $where_value row value
 * @return array
 */
function readSingle($table, $where, $where_value) {
    try  {
        global $conn;
        $sql = "SELECT * FROM $table WHERE $where = $where_value";
//        var_dump($sql);
        $statement = $conn->prepare($sql);
        $statement->bindValue($where_value, $where);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}

/**
 * @param $table table name
 * @return array
 */
function readAll($table) {
    try  {
        global $conn;
        $sql = "SELECT * FROM $table";
        $statement = $conn->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}

/**
 * @param $table table name
 * @return array
 */
function readAllEvents() {
    try  {
        global $conn;
        $sql = "SELECT * FROM events 
                INNER JOIN event_organization_participants e on events.event_ID = e.event_ID
                INNER JOIN users u on u.user_ID = e.user_ID
                INNER JOIN organizations o on o.organization_ID = e.organization_ID
                INNER JOIN event_groups eg on eg.event_ID = events.event_ID
                INNER JOIN orc353_2.groups g on g.group_ID = eg.group_ID;";
        $statement = $conn->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}

/**
 * @param $table table name
 * @param $inputs input
 * @param $where row target
 * @param $where_value row value
 */
function update($table, $inputs, $where, $where_value) {
    try {
        global $conn;
        unset($inputs['csrf']);
        unset($inputs['submit']);
        $data = $inputs;
        $set_data = "";
        for ($i = 0; $i < sizeof($inputs); $i++) {
            $set_data .= array_keys($inputs)[$i] . " = " . "\"" . $data[array_keys($inputs)[$i]] . "\"";
            if ($i < sizeof($inputs) - 1) {
                $set_data .= ", ";
            }
        }
        $sql = "UPDATE $table SET $set_data WHERE $where = $where_value";
        $statement = $conn->prepare($sql);
        $statement->execute($data);
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}

function delete($table, $where, $where_value) {
    try {
        global $conn;
        $sql = "DELETE FROM $table WHERE $where = $where_value";
        var_dump($sql);
        $statement = $conn->prepare($sql);
        $statement->bindValue($where_value, $where);
        $statement->execute();
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}