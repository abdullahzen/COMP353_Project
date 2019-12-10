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

function createPost($group_id, $post_title, $post_text, $user_id){
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

function addPostToEvent($event_id, $post_id){
    try  {
        global $conn;
        $sql = "INSERT INTO event_posts (event_id, post_ID) VALUES ($event_id, $post_id)";
        $statement = $conn->prepare($sql);
        $statement->execute();
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}