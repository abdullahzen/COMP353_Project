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
function createPost($inputs) {
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
function readSinglePost($post_id) {
    try  {
        global $conn;
        $sql = "SELECT g.* FROM `orc353_2`.posts p
            WHERE p.post_ID = $post_id";
//        var_dump($sql);
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
function readAllPosts() {
    try  {
        global $conn;
        $sql = "SELECT DISTINCT p.* FROM `orc353_2`.posts p";
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
function isPostOwner($post_id, $user_id) {
    try  {
        global $conn;
        $sql = "SELECT * FROM `orc353_2`.posts p
        WHERE p.poster_ID = $user_id AND p.post_ID = $post_id";
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
    }
}


/**
 * @param $table table name
 * @param $inputs input
 * @param $where row target
 * @param $where_value row value
 */
function updatePost($table, $inputs, $where, $where_value) {
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

function deletePost($where,$where_value) {
    try {
        global $conn;
        $sql = "DELETE FROM orc353_2.posts WHERE $where = $where_value";
//        var_dump($sql);
        $statement = $conn->prepare($sql);
        $statement->bindValue($where_value, $where);
        $statement->execute();
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}

function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}

function CreatePostForGroup($group_id, $post_title, $post_text, $user_id){
    try  {
        global $conn;
        $sql = "INSERT INTO posts (title, text, poster_ID) VALUES ('$post_title', '$post_text', $user_id)";
        $statement = $conn->prepare($sql);
        $statement->execute();
        $sql = "SELECT LAST_INSERT_ID() as id;";
        $statement = $conn->prepare($sql);
        $statement->execute();
        $id = $statement->fetchAll(PDO::FETCH_ASSOC)[0]['id'];
        return $id;
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}

function addPostToGroup($group_id, $post_id){
    try  {
        global $conn;
        $sql = "INSERT INTO group_posts (group_ID, post_ID) VALUES ($group_id, $post_id)";
        $statement = $conn->prepare($sql);
        $statement->execute();
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}