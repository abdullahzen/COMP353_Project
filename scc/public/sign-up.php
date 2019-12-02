<?php
include 'index.php';

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>Sign up</title>
</head>

<body>
<div class="empty-header-for-sign-in-up"></div>
<div class="container card-signup">
   <h1>Sign Up Form</h1>
    <hr>
    Please fill in this form to create an account.
    <hr>
    <form class="px-4 py-3" action="home.php" method="post">
        <div class="form-group">
            <label for="exampleInputEmail">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail">
        </div>
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name">
        </div>
        <div class="form-group">
            <label for="phone-number">Phone number</label>
            <input type="number" class="form-control" id="phone-number">
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" class="form-control" id="address">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword">
        </div>
        <div class="row">
        <button type="submit" class=" col-12 btn btn-primary">Sign Up</button>
        </div>
    </form>
</div>
</body>

</html>
<!---->
<?php
//include("./config.php");
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
//        header('location: home.php');
//    }
//




