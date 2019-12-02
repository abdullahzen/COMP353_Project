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
        $update = update('bank_information', $_POST, 'bank_information_ID', $_GET['id']);
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}

if (isset($_GET['id'])) {
    try {
        $id = $_GET['id'];
        $result = readSingle('bank_information', 'bank_information_ID', $id);
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

<div align="center">
    <form method="post">
        <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
        <?php foreach ($result as $key => $value) : ?>
            <label for="<?php echo $key; ?>">
                <?php echo ucfirst($key); ?>
            </label>
            <br />
            <input
                type="text"
                name="<?php echo $key; ?>"
                id="<?php echo $key; ?>"
                value="<?php echo escape($value); ?>" <?php echo ($key === 'id' ? 'readonly' : null); ?>
            />
            <br />
        <?php endforeach; ?>
        <input type="submit" name="submit" value="Submit">
    </form>
</div>