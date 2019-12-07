<?php
/**
 * Created by PhpStorm.
 * User: klin
 * Date: 2019-12-05
 * Time: 5:00 PM
 */

require "../../config.php";
require "../../common.php";

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
