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
function createEvent($inputs) {
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
function readSingleEvent($table, $where, $where_value) {
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
function readAllEvents() {
    try  {
        global $conn;
        $sql = "SELECT DISTINCT events.*, COUNT(*) AS participants_num FROM events 
                INNER JOIN event_organization_participants e on events.event_ID = e.event_ID
                INNER JOIN users u on u.user_ID = e.user_ID 
                GROUP BY events.event_ID";
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
function readAllEventsParticipants() {
    try  {
        global $conn;
        $sql = "SELECT * FROM events 
                INNER JOIN event_organization_participants e on events.event_ID = e.event_ID
                INNER JOIN users u on u.user_ID = e.user_ID
                INNER JOIN organizations o on o.organization_ID = e.organization_ID
                INNER JOIN event_groups eg on eg.event_ID = events.event_ID
                INNER JOIN orc353_2.groups g on g.group_ID = eg.group_ID";
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
function readManagedEvents($user_id) {
    try  {
        global $conn;
        $sql = "SELECT DISTINCT events.* FROM events 
        INNER JOIN event_organization_participants e on events.event_ID = e.event_ID
        INNER JOIN users u on u.user_ID = e.user_ID 
        WHERE e.user_ID = $user_id OR events.manager_ID = $user_id";
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
function readParticipatingEvents($user_id) {
    try  {
        global $conn;
        $sql = "SELECT DISTINCT events.*, COUNT(*) AS participants_num FROM events 
        INNER JOIN event_organization_participants e on events.event_ID = e.event_ID
        INNER JOIN users u on u.user_ID = e.user_ID  
        WHERE e.user_ID = $user_id
        GROUP BY events.event_ID";
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
function updateEvent($table, $inputs, $where, $where_value) {
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

function getEventParticipantsNumber(){
    try  {
        global $conn;
        $sql = "SELECT DISTINCT events.*, COUNT(*) AS participants_num FROM events 
                INNER JOIN event_organization_participants e on events.event_ID = e.event_ID
                INNER JOIN users u on u.user_ID = e.user_ID 
                GROUP BY events.event_ID";
        $statement = $conn->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}

function deleteEvent($where, $where_value) {
    global $conn;
    $sql = "DELETE FROM events WHERE $where = $where_value";
//        var_dump($sql);
    $statement = $conn->prepare($sql);
    $statement->bindValue($where_value, $where);
    $statement->execute();
}

function isEventParticipant($user_id, $event_id){
    try  {
        global $conn;
        $sql = "SELECT DISTINCT e.* FROM `orc353_2`.events e
                INNER JOIN event_organization_participants ev on ev.event_ID = e.event_ID
                WHERE ev.user_ID = $user_id AND e.event_ID = $event_id";
        $statement = $conn->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        if (sizeof($result) > 0){
            return true;
        } else {
            return false;
        }
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
        return false;
    }
}

function isEventManager($user_id, $event_id){
    try  {
        global $conn;
        $sql = "SELECT DISTINCT e.* FROM `orc353_2`.events e
                INNER JOIN users u on e.manager_ID = u.user_ID
                WHERE u.user_ID = $user_id AND e.event_ID = $event_id";
        $statement = $conn->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        if (sizeof($result) > 0){
            return true;
        } else {
            return false;
        }
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
        return false;
    }
}