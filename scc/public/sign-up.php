<?php
//include 'header.php';

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Sign up</title>
</head>

<body>
<div class="container">
    Sign Up Form
    <hr>
    Please fill in this form to create an account.
    <form class="px-4 py-3" action="home.php" method="post">
        <div class="form-group">
            <label for="exampleInputEmail">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword">
        </div>
        <button type="submit" class=" btn btn-primary">Sign Up</button>
    </form>
</div>
</body>

</html>



