<?php
require "../app/operations/auth.php";
require "../app/operations/crud.php";
$error = "";

if(session_id() !== '') {
    header("location: role-list.php");
}

if(isset($_POST['submit'])) {
    // username and password sent from form
    $email = escape($_POST['email']);
    $password = escape($_POST['password']);
    $user = login($email, $password);
    $roles = readSingle('user_roles', 'user_ID', $user[0]['user_ID']);
    if(sizeof($user) == 1) {
        ini_set('session.cookie_lifetime', 60 * 60 * 24 * 7);
        setcookie('user_id', $user[0]['user_ID']);
        setcookie('name', $user[0]['name']);
        setcookie('email', $user[0]['email']);
        setcookie('time', time());
        setcookie('isAdmin', false);
        setcookie('isManager', false);
        setcookie('isController', false);
        setcookie('isParticipant', false);
        for($i = 0; $i < sizeof($roles); $i++) {
            switch($roles[$i]['role_ID']) {
                case 1:
                    setcookie('isAdmin', true);
                    break;
                case 2:
                    setcookie('isManager', true);
                    break;
                case 3:
                    setcookie('isController', true);
                    break;
                case 4:
                    setcookie('isParticipant', true);
                    break;
            }
        }
        header("location: index.php");
    } else {
        $error = "Your Login Name or Password is invalid";
    }
}
?>
<!DOCTYPE html>
<html>
<!-- 
// - P2 - Project 2
// - Group 15
// - Team Member, Student IDs, and Emails:
//     Abdulla ALHAJ ZIN, 40013496, email: a_alhajz@encs.concordia.ca
//
//     Kevin LIN, 40002383, email: k_in@encs.concordia.ca
//
//     Nour EL NATOUR,40013102, email: n_elnato@encs.concordia.ca
//
//     Omnia GOMAA, 40017116 , email: o_gomaa@encs.concordia.ca
// -->
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <title>SCC</title>
</head>

<body>
<div class="empty-header-for-sign-in-up"></div>

<div class="center card-signin">
    <h1>Sign in</h1>
    <hr>
    <br>
    <form class="px-4 py-3" method="post">
        <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
        <div class="form-group">
            <label for="error"><?php echo $error ?><br /></label>
        </div>
        <br>
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
        <br>
        <div>
            <input type="submit" name="submit" value="Login">
        </div>
    </form>
    <hr>
    <a href="sign-up.php" >Don't have an account?</a>
</div>
</body>
</html>