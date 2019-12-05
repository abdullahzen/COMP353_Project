<?php
require "../app/operations/auth.php";
$error = "";

if(session_id() !== '') {
    header("location: role-list.php");
}

if(isset($_POST['submit'])) {
    // username and password sent from form
    $email = escape($_POST['email']);
    $password = escape($_POST['password']);
    $user = login($email, $password);
    if(sizeof($user) == 1) {
        ini_set('session.cookie_lifetime', 60 * 60 * 24 * 7);
        setcookie('name', $user[0]['name']);
        setcookie('email', $user[0]['email']);
        setcookie('time', time());
//        header("location: role-list.php");
        header("location: index.php");
    } else {
        $error = "Your Login Name or Password is invalid";
    }
}
?>
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
    <form class="px-4 py-3" method="post">
        <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
        <div class="form-group">
            <label for="error"><?php echo $error ?><br /></label>
        </div>
        <div class="form-group">
            <label for="email">Email address</label><br>
            <input type="text" class="form-control" name="email" id="email">
        </div>
        <br/>
        <div class="form-group">
            <label for="password">Password</label><br>
            <input type="password" name="password" id="password">
        </div>
        <br/>
        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="Check1">
            <label class="form-check-label" for="Check1">Remember me</label>
        </div>
        <br/>
        <div>
            <input type="submit" name="submit" value="Login">
        </div>
    </form>
    <hr>
    <a href="sign-up.php" >Don't have an account?</a>
</div>
</body>
</html>