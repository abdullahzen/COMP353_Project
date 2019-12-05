<?php
/**
 * Created by PhpStorm.
 * User: klin
 * Date: 2019-12-01
 * Time: 5:20 PM
 */

require "../app/operations/crud.php";
require "../app/operations/auth.php";
isLoggedIn();

if (isset($_POST['submit'])) {
//    if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) die();
    try {
        $update = update($_GET['table'], $_POST, $_GET['key'], $_GET['id']);
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
?>
    <script type="text/javascript">
        window.location = "<?php echo escape("/read.php?table=" . $_GET['table']) ?>";
    </script>
<?php
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

<div align="center">
    <form method="post">
        <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
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
                value="<?php echo escape($value); ?>" <?php echo ($key === key($result[0]) ? 'disabled' : null); ?>
            />
            <br />
        <?php
                $index++;
        }
        ?>
        <input type="submit" name="submit" value="Submit">
    </form>
</div>