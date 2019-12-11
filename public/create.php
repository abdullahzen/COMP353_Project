<!--Team Member and their IDs:
Abdulla Alhaj Zin, 40013496, email: a_alhajz@encs.concordia.ca

Lin Kevin, 40002383, email: k_in@encs.concordia.ca

Nour El Natour,40013102, email: n_elnato@encs.concordia.ca

Omnia Gomaa, 40017116 , email: o_gomaa@encs.concordia.ca->

<?php

require "../app/operations/helper.php";
require "../app/operations/crud.php";
require "../app/operations/eventsCrud.php";
require "../app/operations/groupsCrud.php";

$error = null;
$success = null;

if (isset($_POST['submit'])) {
//    if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) die();
    try {
        if ($_COOKIE['current_role'] === 'admin') {
            $create = create($_GET['table'], $_POST);
            $success = $_GET['table'] . "Created successfully";
        }
        if ($_COOKIE['current_role'] === 'manager' && $_GET['table'] === 'events') {
            $create = createEvent($_POST);
            $success = "Event created successfully";
        }
        if ($_COOKIE['current_role'] === 'manager' && $_GET['table'] === 'users') {
            $create = create($_GET['table'], $_POST);
            $success = "User created successfully";
        }
        if ($_COOKIE['current_role'] === 'participant' && $_GET['table'] === 'groups'){
            $create = createGroup($_POST);
            $success = "Group created successfully";
        }
        if ($_COOKIE['table'] === 'groups'){
            $create = createGroup($_POST);
            $success = "Group created successfully";
        }
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}

if (isset($_GET['table'])) {
    $result = describe('orc353_2.'.$_GET['table']);
} else {
    echo "Something went wrong!";
    exit;
}
?>

<?php
include "header.php";
?>
<?php if ($success != null){ ?>
  <div class="alert alert-success" role="alert">
  <?php echo $success;
        if ($_COOKIE['current_role'] == 'manager'){
            echo "<script>setTimeout(function(){
                window.location.href='events.php?';
                }, 1000)</script>";
                exit;
        }
        if ($_COOKIE['current_role'] === 'admin') {
            $table = $_GET['table'];
            echo "<script>setTimeout(function(){
                window.location.href='read.php?table=$table';
                }, 1000)</script>";
                exit;
        }
        if ($_COOKIE['current_role'] === 'participant' || $_COOKIE['current_role'] === 'controller') {
            echo "<script>setTimeout(function(){
                window.location.href='groups.php';
                }, 1000)</script>";
                exit;
        }
        
  ?>
  </div>
<?php } ?>
<?php if ($error != null){ ?>
  <div class="alert alert-danger" role="alert">
  <?php echo $error ?>
  </div>
<?php } ?>
<div class="row">
    <div class="col-2"></div>
    <div class="col-9">
<div class="addToTable">
    <h1>Add to <?php echo $_GET['table'] ?></h1>
    <form method="post">
        <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
        <?php
            $index = 0;
            foreach ($result as $key => $value) {
                if($value['Field'] !== $result[0]['Field'] || $_COOKIE['current_role'] === 'admin') {
                    if ($_COOKIE['current_role'] === 'admin'){
                        if ($value['Field'] === trim($_GET['table'], 's').'_ID' || ($value['Field'] === 'bank_information_ID' && $_GET['table'] === 'bank_information')){
                            $index++;
                            continue;
                        }
                    }
                    if ($value['Field'] === 'timestamp'){
                        $index++;
                        continue;
                    }
                    if ($value['Field'] === 'manager_ID' && $_COOKIE['current_role'] != 'admin'){
                        $index++;
                        continue;
                    }
                    ?>
                    <label for="<?php echo $value['Field']; ?>">
                        <?php echo ucfirst($value['Field']); ?>
                    </label>
                    <br/>
                    <input
                        
                        name="<?php echo $value['Field']; ?>"
                        id="<?php echo $value['Field']; ?>"
                        <?php
                            if ($_GET['table'] === 'events' && $_COOKIE['user_id'] !== NULL && $value['Field'] === 'manager_ID' && $_COOKIE['current_role'] === 'participant') {
                                echo "value = '" . escape($_COOKIE['user_id']) . "' readonly";
                            } else {
                                echo "value = ''";
                            }
                             if ($_GET['table'] === 'users' && $value['Field'] === 'password'){
                            echo 'type="password"';
                        } else {
                            echo 'type="text"';
                        }?>
                    />
                    <br/>
                    <?php
                    $index++;
                }
            }
        ?>
        <input type="submit" name="submit" value="Submit">
    </form>
</div>
</div>
</div>