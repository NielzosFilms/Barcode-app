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

<head>
    <script src="js/videosub.js"></script>
</head>

<table>
    <?php
        $exercises=$pdo->query("SELECT * FROM parcel");
        while ($row = $exercises->fetch()) {
            ?>
    <tr>
        <td><?= $row["Pic"]?></td>

        <td><a href="index.php?alibiID=<?= $row["AlibiID"]?>"><?= $row["AlibiID"]?></a></td>
        <td><?= $row["ParcelData1"]?></td>
        <td><?= $row["ParcelData2"]?></td>
        <td><?= $row["ParcelData3"]?></td>
    </tr>
    <?php
        }
    ?>
</table>

<video id="vid1" width="640" height="480" controls="controls">
    <source src="videos/test_srt.mp4" type="video/mp4" />
    <track src="videos/test_srt.srt" kind="subtitle" srclang="en-US" label="English" default />
    Your browser does not support the video tag.
</video>
<br>

<?php

$sub = new Subtitle("videos/test_srt.srt");

if (!empty($_GET["alibiID"])) {
    $key = $sub->searchSubtitles($_GET["alibiID"]);
    if ($key != null) {
        $startTime = $sub->getStartTime($key-1);
        $endTime = $sub->getEndTime($key-1);

        echo "BlockIndex: ".$sub->getLine($key-2)."<br>";
        echo "StartTime: ".$startTime."<br>";
        echo "EndTime: ".$endTime."<br>";
        $timeSec = $sub->getTimeInSec($startTime);
        echo "$timeSec<br>"; ?>
<?php
    } else {
        echo "AlibiID: ".$_GET["alibiID"]." Not found.";
    }
}
?>