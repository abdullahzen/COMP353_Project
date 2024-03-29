<?php
// <!-- 
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

require "../app/operations/crud.php";
$error = null;
$success = null;
if (isset($_POST['submit'])) {
//    if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) die();
    try {
        $update = update($_GET['table'], $_POST, $_GET['key'], $_GET['id']);
        $success = $_GET['table'] . " updated successfully.";
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}

if (isset($_GET['table']) && isset($_GET['key']) && isset($_GET['id'])) {
    try {
        $result = readSingle($_GET['table'], $_GET['key'], $_GET['id']);
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
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
    if ($_COOKIE['current_role'] === 'admin') {
        $table = $_GET['table'];
        echo "<script>setTimeout(function(){
            window.location.href='./read.php?table=$table';
            }, 1000)</script>";
            exit;
    }
    if ($_COOKIE['current_role'] === 'manager') {
        echo "<script>setTimeout(function(){
            window.location.href='./events.php';
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
    <div class="col-4"></div>
    <div class=" update col-4">
    <h1>Update this entry in <?php echo $_GET['table'] ?></h1>
    <form method="post">
        <input name="csrf" type="hidden" value="<?php echo ($_SESSION['csrf']); ?>">
        <?php
            $index = 0;
            foreach ($result[0] as $key => $value) { ?>
            <label for="<?php echo $key; ?>">
                <?php echo ucfirst($key); ?>
            </label>
            <br />
            <input
                type="text"
                name="<?php echo $key; ?>"
                id="<?php echo $key; ?>"
                value="<?php echo ($value); ?>" <?php echo ($key === key($result[0]) || $key === 'manager_ID' ? 'disabled' : null); ?>
            />
            <br />
        <?php
                $index++;
        }
        ?>
        <input type="submit" name="submit" value="Submit">
    </form>
    </div>
</div>

