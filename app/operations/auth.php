<?php

require "../config.php";
require "../common.php";

// <!-- 
// - P2 - Project 2
// - Group 15
// - Team Member, Student IDs, and Emails:
//     Abdulla ALHAJ ZIN, 40013496, email: a_alhajz@encs.concordia.ca

//     Kevin LIN, 40002383, email: k_in@encs.concordia.ca

//     Nour EL NATOUR,40013102, email: n_elnato@encs.concordia.ca

//     Omnia GOMAA, 40017116 , email: o_gomaa@encs.concordia.ca
// -->


try {
    $conn = new PDO("mysql:dbname=$dbname;host=$host", $username, $password, $options);
} catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
}

/**
 * @param $email
 * @param $password
 * @return array of user found
 */
function login($email, $password) {
    try  {
        global $conn;
        $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
        $statement = $conn->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}

/**
 * Logout function
 */
function logout() {
    if (isset($_SERVER['HTTP_COOKIE'])) {
        $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
        foreach($cookies as $cookie) {
            $parts = explode('=', $cookie);
            $name = trim($parts[0]);
            setcookie($name, '', time()-1000);
            setcookie($name, '', time()-1000, '/');
        }
        header("location: index.php");
    }
}

/**
 * Redirects to index.php if no session is detected
 */
function isLoggedIn() {
    if($_COOKIE['email'] === null || $_COOKIE['name'] === null || $_COOKIE['time'] === null) {
        header("location: index.php");
    }
}
