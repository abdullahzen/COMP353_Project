<?php
//include 'index.php';

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Sign up</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
<div class="empty-header-for-sign-in-up"></div>
<div class="container card-signup">
   <h1>Sign Up</h1>
    <hr>
    <form class="px-4 py-3" action="role-list.php" method="post">
        <div class="form-group">
            <label for="email">Email address</label><br>
            <input type="email" class="form-control" id="email">
        </div><br>
        <div class="form-group">
            <label for="name">Name</label><br>
            <input type="text" class="form-control" id="name">
        </div><br>
        <div class="form-group">
            <label for="phone-number">Phone number</label><br>
            <input type="number" class="form-control" id="phone-number">
        </div><br>
        <div class="form-group">
            <label for="address">Address</label><br>
            <input type="text" class="form-control" id="address">
        </div><br>
        <div class="form-group">
            <label for="password">Password</label><br>
            <input type="password" class="form-control" id="password">
        </div><br>
        <div>
        <input type="submit"/>
        </div>
    </form>
</div>
</body>

</html>
<!---->
<?php
//include("../../config.php");
//session_start();
//
//// initializing variables
//$name = "";
//$email    = "";
//$phone_number = "";
//$address = "";
//$password = "";
//$errors = array();
//
//// connect to the database
//$db = mysqli_connect('localhost', 'root', '', 'orc353_2');
//
//// REGISTER USER
//if (isset($_POST['users'])) {
//    // receive all input values from the form
//    $name = mysqli_real_escape_string($db, $_POST['name']);
//    $email = mysqli_real_escape_string($db, $_POST['email']);
//    $password = mysqli_real_escape_string($db, $_POST['password']);
//    $address = mysqli_real_escape_string($db, $_POST['address']);
//    $phone_number = mysqli_real_escape_string($db, $_POST['phone-number']);
//
//    // form validation: ensure that the form is correctly filled ...
//    // by adding (array_push()) corresponding error unto $errors array
//    if (empty($username)) { array_push($errors, "Username is required"); }
//    if (empty($email)) { array_push($errors, "Email is required"); }
//    if (empty($password)) { array_push($errors, "Password is required"); }
//    }
//
//    // first check the database to make sure
//    // a user does not already exist with the same username and/or email
//    $user_check_query = "SELECT * FROM users WHERE name='$name' OR email='$email' LIMIT 1";
//    $result = mysqli_query($db, $user_check_query);
//    $user = mysqli_fetch_assoc($result);
//
//    if ($user) { // if user exists
//        if ($user['name'] === $name) {
//            array_push($errors, "Username already exists");
//        }
//
//        if ($user['email'] === $email) {
//            array_push($errors, "email already exists");
//        }
//    }
//
//    // Finally, register user if there are no errors in the form
//    if (count($errors) == 0) {
//        $password = md5($password);//encrypt the password before saving in the database
//
//        $query = "INSERT INTO 'orc353_2'.'users' (name, email, password, address, phone_number)
//  			  VALUES('$name', '$email', '$password', '$address', '$phone_number')";
//        mysqli_query($db, $query);
//        $_SESSION['name'] = $name;
//        $_SESSION['success'] = "You are now logged in";
////        header('location: index.php');
//    }





