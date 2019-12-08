<?php

require "../config.php";

try {
    $conn = new PDO("mysql:dbname=$dbname;host=$host", $username, $password, $options);
} catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
}

/**
 * @param $inputs
 */
function createGroup($inputs) {
    try  {
        global $conn;
        unset($inputs['csrf']);
        unset($inputs['submit']);
        $user_id = $_COOKIE['user_id'];
        $data = $inputs;
        $set_data = "";
        for ($i = 0; $i < sizeof($inputs); $i++) {
            $set_data .= array_keys($inputs)[$i] . " = " . "\"" . $data[array_keys($inputs)[$i]] . "\"";
            if ($i < sizeof($inputs) - 1) {
                $set_data .= ", ";
            }
        }

        //create event
        $sql = sprintf(
        "INSERT INTO %s (%s) values (%s)",
            "events",
            implode(", ", array_keys($inputs)),
            ":" . implode(", :", array_keys($inputs))
        );

        $statement = $conn->prepare($sql);
        $statement->execute($inputs);

        //sets user to be a manager if not already
        if($_COOKIE['isManager'] === false) {
            $sql = sprintf(
                "INSERT INTO %s (%s) values (%s)",
                "user_roles",
                implode(", ", array('user_ID', 'role_ID')),
                ":" . implode(", :", array($user_id, '2'))
            );

            $statement = $conn->prepare($sql);
            $statement->execute($inputs);
            setcookie('isManager', true);
        }
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
function readSingleGroup($table, $where, $where_value) {
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
 * @return array
 */
function readAllGroups() {
    try  {
        global $conn;
        $sql = "SELECT DISTINCT g.* FROM `orc353_2`.groups g
                INNER JOIN group_members ge on ge.group_ID = g.group_ID
                INNER JOIN users u on u.user_ID = ge.user_ID";
        $statement = $conn->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}

/**
 * @return array
 */
function readEventsFromGroup($group_id) {
    try  {
        global $conn;
        $sql = "SELECT DISTINCT e.* FROM `orc353_2`.groups g
                INNER JOIN event_groups ge on ge.group_ID = g.group_ID
                INNER JOIN events e on e.event_ID = ge.event_ID
                WHERE g.group_ID = $group_id";
        $statement = $conn->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}

/**
 * @return array
 */
function readManagedGroups($user_id) {
    try  {
        global $conn;
        $sql = "SELECT DISTINCT g.* FROM `orc353_2`.groups g
        INNER JOIN group_members ge on g.group_ID = ge.group_ID
        INNER JOIN users u on u.user_ID = ge.user_ID 
        WHERE u.user_ID = $user_id OR g.manager_ID = $user_id";
        $statement = $conn->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}

/**
 * @return array
 */
function readGroupsMemberOf($user_id) {
    try  {
        global $conn;
        $sql = "SELECT DISTINCT g.* FROM orc353_2.groups g
        INNER JOIN group_members ge on g.group_ID = ge.group_ID
        INNER JOIN users u on u.user_ID = ge.user_ID 
        WHERE u.user_ID = $user_id";
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
function updateGroup($table, $inputs, $where, $where_value) {
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

function isGroupMember($user_id, $group_id){
    try  {
        global $conn;
        $sql = "SELECT DISTINCT ge.* FROM `orc353_2`.groups g
                INNER JOIN group_members ge on g.group_ID = ge.group_ID
                INNER JOIN users u on u.user_ID = ge.user_ID 
                WHERE u.user_ID = $user_id AND g.group_ID = $group_id";
        $statement = $conn->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        if (sizeof($result) > 0){
            if ($result[0]['admitted'] == 1){
                return 'joined';
            } else {
                return 'pending';
            }
        } else {
            return 'not';
        }
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}

function getGoupsMembersNumber(){
    try  {
        global $conn;
        $sql = "SELECT DISTINCT g.*, COUNT(*) AS members_num FROM `orc353_2`.groups g
                INNER JOIN group_members ge on g.group_ID = ge.group_ID
                INNER JOIN users u on u.user_ID = ge.user_ID 
                WHERE ge.admitted = TRUE
                GROUP BY g.group_ID";
        $statement = $conn->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}

function joinGroup($group_id, $user_id){
    global $conn;
    $sql = "INSERT INTO group_members (group_ID, user_ID) VALUES ($group_id, $user_id)";
    $statement = $conn->prepare($sql);
    $statement->execute();
}

function deleteGroup($where,$where_value) {
    try {
        global $conn;
        $sql = "DELETE FROM orc353_2.groups WHERE $where = $where_value";
//        var_dump($sql);
        $statement = $conn->prepare($sql);
        $statement->bindValue($where_value, $where);
        $statement->execute();
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}