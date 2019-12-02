<?php
//include("config.php");
//session_start();
//
//if($_SERVER["REQUEST_METHOD"] == "POST") {
//    // username and password sent from form
//
//    $name = mysqli_real_escape_string($db,$_POST['username']);
//    $password = mysqli_real_escape_string($db,$_POST['password']);
//
//    $sql = "SELECT id FROM admin WHERE username = '$name' and password = '$password'";
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
//        header("location: home.php");
//    }else {
//        $error = "Your Login Name or Password is invalid";
//    }
//}
//?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <meta charset="UTF-8">
    <title>SCC</title>
</head>

<body>
<div class="container">
    <form class="px-4 py-3" action="home.php" method="post">
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1">
        </div>
        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Remember me</label>
        </div>
        <button type="submit" class=" btn btn-primary">Sign in</button>
    </form>
</div>
</body>

</html>