<!--Team Member and their IDs:
Abdulla Alhaj Zin, 40013496, email: a_alhajz@encs.concordia.ca

Lin Kevin, 40002383, email: k_in@encs.concordia.ca

Nour El Natour,40013102, email: n_elnato@encs.concordia.ca

Omnia Gomaa, 40017116 , email: o_gomaa@encs.concordia.ca-->

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
 * @return array
 */
function readSingleEvent($event_id) {
    try  {
        global $conn;
        $sql = "SELECT * FROM orc353_2.events WHERE events.event_ID = $event_id";
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
function readPostsOfEvent($event_id) {
    try  {
        global $conn;
        $sql = "SELECT p.* FROM orc353_2.events e 
        INNER JOIN event_posts ep on ep.event_ID = e.event_ID
        INNER JOIN posts p on p.post_ID = ep.post_ID
        WHERE e.event_ID = $event_id
        ORDER BY p.timestamp DESC";
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
function readGroupsOfEvent($event_id) {
    try  {
        global $conn;
        $sql = "SELECT g.* FROM orc353_2.events e 
        INNER JOIN event_groups ge on ge.event_ID = e.event_ID
        INNER JOIN orc353_2.groups g on g.group_ID = ge.group_ID
        WHERE e.event_ID = $event_id";
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
function isInCurrentEvent($user_id, $event_id) {
    try  {
        global $conn;
        $sql = "SELECT e.* FROM orc353_2.events e 
        INNER JOIN event_organization_participants eu on eu.event_ID = e.event_ID
        WHERE e.event_ID = $event_id AND (eu.user_ID = $user_id OR e.manager_ID = $user_id)";
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

function addParticipantToEvent($event_id, $organization_id, $user_id){
    try  {
        global $conn;
        $sql = "INSERT INTO event_organization_participants (event_ID, organization_ID, user_ID) VALUES ($event_id, $organization_id,$user_id)";
        $statement = $conn->prepare($sql);
        $statement->execute();
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}


/**
 * @return array
 */
function readParticipantsOfEvent($event_id) {
    try  {
        global $conn;
        $sql = "SELECT u.* FROM orc353_2.events e 
        INNER JOIN event_organization_participants eu on eu.event_ID = e.event_ID
        INNER JOIN orc353_2.users u on u.user_ID = eu.user_ID
        WHERE e.event_ID = $event_id";
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
function updateEvent($inputs, $where, $where_value) {
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
        $sql = "UPDATE orc353_2.events SET $set_data WHERE $where = $where_value";
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

function readOrganizationIdOfEvent($event_id){
    try  {
        global $conn;
        $sql = "SELECT eu.* FROM `orc353_2`.events e
                INNER JOIN event_organization_participants eu on eu.event_ID = e.event_ID
                WHERE e.event_ID = $event_id";
        $statement = $conn->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        if (sizeof($result) > 1){
            $result = $result[1]['organization_ID'];
            return $result;
        } else if (sizeof($result) > 0){
            $result = $result[0]['organization_ID'];
            return $result;
        }
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
        return false;
    }
}