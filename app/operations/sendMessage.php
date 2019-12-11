<!-- 
- P2 - Project 2
- Group 15
- Team Member, Student IDs, and Emails:
    Abdulla ALHAJ ZIN, 40013496, email: a_alhajz@encs.concordia.ca

    Kevin LIN, 40002383, email: k_in@encs.concordia.ca

    Nour EL NATOUR,40013102, email: n_elnato@encs.concordia.ca

    Omnia GOMAA, 40017116 , email: o_gomaa@encs.concordia.ca
-->

<?php

require "../config.php";

try {
    $conn = new PDO("mysql:dbname=$dbname;host=$host", $username, $password, $options);
} catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
}

function sendMessage($sender_id, $receiver_id, $text) {
    try {
        global $conn;
        $sql = "INSERT INTO messages (sender_ID, receiver_ID, text) VALUES ($sender_id, $receiver_id, '$text')";
        $statement = $conn->prepare($sql);
        $statement->execute();
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}

function readMessages($table, $sender_id, $receiver_id) {
  try  {
      global $conn;
      $sql = "SELECT * FROM `orc353_2`.messages WHERE sender_ID = $sender_id AND receiver_ID = $receiver_id 
      ORDER BY messages.timestamp ASC";
      $statement = $conn->prepare($sql);
      $statement->execute();
      $result = $statement->fetchAll(PDO::FETCH_ASSOC);
      return $result;
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
}

function countMessages($source_id ,$user_id) {
  try  {
      global $conn;
      $sql = "SELECT COUNT(*) as num FROM `orc353_2`.messages m 
      WHERE (m.sender_ID = $user_id AND m.receiver_ID = $source_id) 
      OR (m.receiver_ID = $user_id AND m.sender_ID = $source_id)";
      $statement = $conn->prepare($sql);
      $statement->execute();
      $result = $statement->fetchAll(PDO::FETCH_ASSOC);
      return $result;
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
}


function cmp($a, $b){
  $ad = strtotime($a['timestamp']);
  $bd = strtotime($b['timestamp']);
  return ($ad-$bd);
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

