<?php

//include 'index.php';
//
//include("config.php");
//session_start();
//
//if($_SERVER["REQUEST_METHOD"] == "POST") {
//    // username and password sent from form
//
//    $name = mysqli_real_escape_string($db,$_POST['username']);
//    $password = mysqli_real_escape_string($db,$_POST['password']);
//
//    $sql = "SELECT id FROM users WHERE username = '$name' and password = '$password'";
//    $result = mysqli_query($db,$sql);
//    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
//    $active = $row['active'];
//
//    $count = mysqli_num_rows($result);
//
//    // If result matched $name and $password, table row must be 1 row
//
//    if($count == 1) {
//        session_register("name");
//        $_SESSION['login_user'] = $name;
//
//        header("location: index.php");
//    }else {
//        $error = "Your Login Name or Password is invalid";
//    }
//}
//?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <title>SCC</title>
</head>

<body>
<div class="empty-header-for-sign-in-up"></div>

<div class="container card-signin">
    <h1>Sign in</h1>
    <hr>
    <br>
    <form class="px-4 py-3" action="role-list.php" method="post">
        <div class="form-group">
            <label for="email1">Email address</label><br>
            <input type="email" class="form-control" id="email1">
        </div>
        <br>
        <div class="form-group">
            <label for="password1">Password</label><br>
            <input type="password"  id="password1">
        </div>
        <br>
        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="Check1">
            <label class="form-check-label" for="Check1">Remember me</label>
        </div>
        <br>
        <div>
            <button type="submit" >
                <?php
                session_start();
                ?>
                Sign in</button>
        </div>
    </form>
    <hr>
    <div>Don't have an account?<br>
        <form action="sign-up.php"><br>
            <input type="submit" value="Sign Up" />
        </form>
    </div>
</div>
</body>

</html>