<?php
/**
 * Created by PhpStorm.
 * User: klin
 * Date: 2019-12-01
 * Time: 5:20 PM
 */

require "../app/operations/crud.php";

$success = null;

if (isset($_GET['table'])) {
    try {
        $table = $_GET['table'];
        $result = readAll($table);
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
} else {
    echo "Something went wrong!";
    exit;
}

if (isset($_POST["submit"])) {
//    if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) die();
    try {
        delete($_GET['table'], key($result[0]), $_POST["submit"]);
        $success = "User successfully deleted";
?>
    <script type="text/javascript">
        window.location = "<?php echo escape("/read.php?table=" . $_GET['table']) ?>";
    </script>
<?php
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}
?>
<?php
    include "header.php";
?>
<?php
    if (sizeof($result) > 0) {
?>
<form method="post">
    <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
    <a href="create.php?table=<?php echo escape($table) ?>">Create new entry for <?php echo escape($table) ?></a>
    <table align="center">
        <thead>
            <tr>
                <?php foreach($result[0] as $key => $value){ ?>
                    <th>
                        <?php echo $key; ?>
                    </th>
                <?php } ?>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $index = 0;
            foreach ($result as $key => $value) { ?>
                <tr>
                    <?php
                        foreach ($result[$index] as $key => $value) {
                    ?>
                            <td><?php echo $result[$index][$key]; ?></td>
                    <?php
                        }
                    ?>
                    <td><a href="update.php?table=<?php echo escape($table) ?>&key=<?php echo escape(key($result[$index])) ?>&id=<?php echo escape($result[$index][key($result[$index])]); ?>">Edit</a></td>
                    <td><button type="submit" name="submit" value="<?php echo escape($result[$index][key($result[$index])]); ?>">Delete</button></td>
                </tr>
            <?
                $index++;
            }
            ?>
        </tbody>
    </table>
</form>
<?php } else { ?>
    <blockquote>No results found.</blockquote>
<?php
} ?>