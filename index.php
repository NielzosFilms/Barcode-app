<?php
spl_autoload_register(
    function ($class_name) {
        include $class_name . '.class.php';
    }
);

$dsn = "mysql:host=localhost;dbname=barcode_app";
$user = "root";
$passwd = "";
$pdo = new PDO($dsn, $user, $passwd);
?>

<table>
    <?php
        $exercises=$pdo->query("SELECT * FROM parcel");
        while ($row = $exercises->fetch()) {
            ?>
    <tr>
        <td><?= $row["Pic"]?></td>
        <td><?= $row["AlibiID"]?></td>
        <td><?= $row["ParcelData1"]?></td>
        <td><?= $row["ParcelData2"]?></td>
        <td><?= $row["ParcelData3"]?></td>
    </tr>
    <?php
        }
    ?>
</table>

<?php
/**
 * 00120200615153135100061
 * test id code
 */
$id = "00120200615153135100061";

$sub = new Subtitle("videos/test_srt.srt");
$key = $sub->searchSubtitles($id);
$startTime = $sub->getStartTime($key-1);
$endTime = $sub->getEndTime($key-1);
echo $startTime."<br>";
echo $endTime;

?>