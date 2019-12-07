<?php
/**
 * Created by PhpStorm.
 * User: klin
 * Date: 2019-12-01
 * Time: 5:20 PM
 */

if($_COOKIE['email'] !== null && $_COOKIE['name'] !== null && $_COOKIE['time'] !== null) {
    header("location: role-list.php");
} else {
    header("location: public/sign-in.php");
}
