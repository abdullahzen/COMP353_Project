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
    <form class="px-4 py-3" action="sign-in.php" method="post">
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
<?php
//
//// initializing variables
//$name = "";
//$email    = "";
//$phone_number = "";
//$address = "";
//$password = "";
//$errors = array();
//
//// REGISTER USER
//if (isset($_POST['submit'])) {
//    // receive all input values from the form
//    $name = escape($_POST['name']);
//    $email = escape($_POST['email']);
//    $phone_number = escape($_POST['phone-number']);
//    $address = escape( $_POST['address']);
//    $password = escape($_POST['password']);
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
//    $user_check_query = "SELECT email FROM users WHERE email='$email'";
//    //    $result = query($user_check_query);
//    if ($user_check_query == null){
//        $user = fetch($user_check_query);
//    }
//    else { // if user exists
//            array_push($errors, "Email already exists");
//    }
//
//    // Finally, register user if there are no errors in the form
//    if (count($errors) == 0) {
//        $password = md5($password);//encrypt the password before saving in the database
//
//        $query = "INSERT INTO 'users' (name, email, password, address, phone_number)
//  			  VALUES('$name', '$email', '$password', '$address', '$phone_number')";
//
//        $statement = prepare($query);
//        $statement->execute();
////        query($query);
////        $_SESSION['name'] = $name;
////        $_SESSION['success'] =  "You are now logged in";
//        header('location: login.php');
//    }





