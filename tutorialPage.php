<?php include "template.php";
/** @var $conn */

if (isset($_GET["tutorialID"])) {
    $learnID = $_GET["tutorialID"];
}


$sql = $conn->query("SELECT Name,Text FROM Learn WHERE ID = " . $learnID);
$result = $sql->fetch();
$learnID = $result["ID"];
$title = $result[0];
$learnText = $result[1];
?>
<title>CyberCity - Learn Page</title>
<h1>Learn - <?= $title ?></h1>
<div class="container-fluid"></div>

<div class="col-10"><?= $learnText ?></div>