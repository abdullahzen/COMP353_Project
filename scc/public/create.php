<?php
/**
 * Created by PhpStorm.
 * User: klin
 * Date: 2019-12-02
 * Time: 6:36 PM
 */

require "../app/operations/helper.php";
require "../app/operations/crud.php";

if (isset($_POST['submit'])) {
//    if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) die();
    try {
        $create = create($_GET['table'], $_POST);
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

if (isset($_GET['table'])) {
    $result = describe($_GET['table']);
} else {
    echo "Something went wrong!";
    exit;
}
?>

<?php
include "header.php";
?>

<div class="content addToTable" align="center">
    <h1>Add a new entry to: <?php echo $_GET['table'] ?></h1>
    <form method="post">
        <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
        <?php
            $index = 0;
            foreach ($result as $key => $value) {
                if($value['Field'] !== $result[0]['Field']) {
                    ?>
                    <label for="<?php echo $value['Field']; ?>">
                        <?php echo ucfirst($value['Field']); ?>
                    </label>
                    <br/>
                    <input
                        type="text"
                        name="<?php echo $value['Field']; ?>"
                        id="<?php echo $value['Field']; ?>"
                        <?php
                            if ($_GET['table'] === 'events' && $_COOKIE['user_id'] !== NULL && $value['Field'] === 'manager_ID' && $_COOKIE['current_role'] === 'participant') {
                                echo "value = '" . escape($_COOKIE['user_id']) . "' readonly";
                            } else {
                                echo "value = ''";
                            }
                        ?>
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