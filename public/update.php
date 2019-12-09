<?php
/**
 * Created by PhpStorm.
 * User: klin
 * Date: 2019-12-01
 * Time: 5:20 PM
 */

require "../app/operations/crud.php";

if (isset($_POST['submit'])) {
//    if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) die();
    try {
        $update = update($_GET['table'], $_POST, $_GET['key'], $_GET['id']);
        ?>
        <script type="text/javascript">
            window.location = "
            <?php
                if ($_COOKIE['current_role'] === 'admin') {
                    echo "/read.php?table=" . $_GET['table'];
                }
                if ($_COOKIE['current_role'] === 'manager') {
                    echo "/events.php";
                }
                ?>";
        </script>
        <?php
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
<div class="row">
    <div class="col-4"></div>
    <div class="col-4">
    <h1>Update entry in: <?php echo $_GET['table'] ?></h1>
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
    
