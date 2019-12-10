<!--Team Member and their IDs:
Abdulla Alhaj Zin, 40013496, email: a_alhajz@encs.concordia.ca

Lin Kevin, 40002383, email: k_in@encs.concordia.ca

Nour El Natour,40013102, email: n_elnato@encs.concordia.ca

Omnia Gomaa, 40017116 , email: o_gomaa@encs.concordia.ca->

<?php

require "../app/operations/crud.php";
include "header.php";

$success = null;
$error = null;

try {
    $user_id = readSingle('user_bank_information', 'bank_information_ID', $_GET['id'])[0]['user_ID'];
    if ($_COOKIE['user_id'] == $user_id){
        $result = readSingle('bank_information', 'bank_information_ID', $_GET['id']);
    } else {
        throw new PDOException();
    }

    if (isset($_GET['delete'])){
      $user_id = readSingle('user_bank_information', 'bank_information_ID', $_GET['id'])[0]['user_ID'];
      if ($_COOKIE['user_id'] == $user_id){
        delete('bank_information','bank_information_ID', $_GET['id']);
        $success = 'Your bank information was delete successfully.';
      }
    }
?>
<?php
} catch(PDOException $e) {
    $error = "You can only view your own bank information. Redirecting to your profile page.";
}


?>

<?php if ($success != null){ ?>
  <div class="alert alert-success" role="alert">
  <?php echo $success;
  $id = $_COOKIE['user_id'];
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
  if ($error === "You can only view your own bank information. Redirecting to your profile page."){
    echo $error;
?>
<?php
    $id = $_COOKIE['user_id'];
    echo "<script>setTimeout(function(){
        window.location.href='user.php?id=$id';
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
            <h3><b>Your Bank Information
             </b></h3>   
        </div>
        <div class="card-body">
            <p class="card-text"><b>Cardholder Name:</b><br>
                <?php echo $result['cardholder_name'] ?>
            </p>
            <p class="card-text"><b>Address:</b><br>
                <?php echo $result['address'] ?>
            </p>                
            <p class="card-text"><b>Card Number:</b><br>
                <?php echo $result['card_number'] ?>
            </p>
            <p class="card-text"><b>Expiration Date:</b><br>
              <?php echo $result['expiration_date'] ?>
            </p>
            <button type="button" class="btn btn-secondary pull-right" onclick="window.location='update.php?table=bank_information&key=<?php echo escape(key($result)) ?>&id=<?php echo escape($result[key($result)]);?>';">
                Edit
            </button>
            <button type="button" class="btn btn-danger pull-right mr-2" onclick="window.location='bank_information.php?id=<?php echo $_GET['id'] ?>&delete=';">
                Delete
            </button>
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