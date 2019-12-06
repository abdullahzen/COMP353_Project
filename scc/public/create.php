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
        window.location = "<?php echo escape("/read.php?table=" . $_GET['table']) ?>";
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
                    value=""
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