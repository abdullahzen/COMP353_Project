<?php

require "../app/operations/crud.php";
require "../app/operations/eventsCrud.php";
require "../app/operations/groupsCrud.php";
include "header.php";

$success = null;
$error = null;

try {
    if ($_COOKIE['user_id']){
        $result = readSingle('users', 'user_ID', $_GET['id']);
        $events = readParticipatingEvents($_GET['id']);
        $groups = readGroupsMemberOf($_GET['id']);
    } else {
        throw new PDOException();
    }
?>
<?php
} catch(PDOException $e) {
    $error = "You are not logged in and cannot view any user's profile. Redirecting to sign in page.";
}


?>

<?php if ($success != null){ ?>
  <div class="alert alert-success" role="alert">
  <?php echo $success;
  $id = $_GET['id'];
  echo "<script>setTimeout(function(){
    window.location.href='./user.php?id=$id';
    }, 1000)</script>";
    exit;
  ?>
  </div>
<?php } ?>
<?php if ($error != null){ ?>
  <div class="alert alert-danger" role="alert">
  <?php
  if ($error === "You are not logged in and cannot view any user's profile. Redirecting to sign in page."){
    echo $error;
?>
<?php
    echo "<script>setTimeout(function(){
        window.location.href='sign-in.php';
    }, 3000)</script>";
    exit;
?>
<?php } else {
    echo $error;
}
  ?>
</div>

<?php } ?>
<?php
    if ($result) {
        $result = $result[0];
?>
<div class="container">

    <div class="card text-center">
        <div class="card-header">
            <h3><b><?php 
            if ($_COOKIE['user_id'] == $result['user_ID']){
                echo "Your Profile";
            } else {
            echo $result['name']."'s Profile"; }
             ?></b></h3>   
        </div>
        <div class="card-body">
            <p class="card-text"><b>Name:</b><br>
                <?php echo $result['name'] ?>
            </p>
            <p class="card-text"><b>Email:</b><br>
                <?php echo $result['email'] ?>
            </p>
            <?php if ($_COOKIE['user_id'] == $result['user_ID']){?>
                
            <p class="card-text"><b>Address:</b><br>
                <?php echo $result['address'] ?>
            </p>
            <p class="card-text"><b>Password:</b><br>
                <?php echo '*****' ?>
            </p>
            
            <p class="card-text"><b>Phone Number:</b><br>
                <?php echo $result['phone_number'] ?>
            </p>
            <?php 
                $id = readSingle('user_bank_information', 'user_ID', $_GET['id']);
                if (sizeof($id) > 0){
                    $id = $id[0]['bank_information_ID'];
                    ?>
            <p class="card-text"><b>Bank Information:</b><br>
                
                <a href='bank_information.php?id=<?php echo $id ?>'><?php
                echo readSingle('bank_information', 'bank_information_ID', $id)[0]['card_number'] ?></a>
            </p>
                <?php } ?>
            <?php } ?>

            <p class="card-text"><b>Joined Groups:</b><br>
                <?php if (sizeof($groups) > 0){?>
                    <ul>
                    <?php
                    $index = 0;
                    foreach($groups as $key => $value){?>
                        <li><span class="btn btn-link" onclick="window.location='group.php?id=<?php echo $groups[$index]['group_ID'] ?>';"><?php echo $groups[$index]['name'] ?></span>
                        </li>
                    <?php 
                        $index++;
                    }
                    ?>
                    </ul>
                    <?php
                    } else {?>
                    None
                    <?php }
                ?>
            </p>

            <p class="card-text"><b>Participating Events:</b><br>
                <?php if (sizeof($events) > 0){?>
                    <ul>
                    <?php
                    $index2 = 0;
                    foreach($events as $key => $value){?>
                        <li><span class="btn btn-link" onclick="window.location='event.php?id=<?php echo $events[$index2]['event_ID'] ?>';"><?php echo $events[$index2]['name'] ?></span>
                        </li>
                    <?php 
                        $index2++;
                    }
                    ?>
                    </ul>
                    <?php
                    } else {?>
                    None
                    <?php }
                ?>
            </p>
            <?php if ($_COOKIE['user_id'] == $result['user_ID']){?>
                <button type="button" class="btn btn-secondary pull-right" onclick="window.location='update.php?table=users&key=<?php echo escape(key($result)) ?>&id=<?php echo escape($result[key($result)]);?>';">
                    Edit
                </button>
            <?php } else {?>
                <button type="button" class="btn btn-secondary pull-right" href="message.php?id=<?php echo $result['user_ID'] ?>;">
                    Message User
                </button>
            <?php }?>
        </div>
        <div class="card-footer text-muted">
        </div>
    </div>
    <hr>
</div>
<?php } else { ?>
    <blockquote>No results found.</blockquote>
<?php
} ?>