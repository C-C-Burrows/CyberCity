<?php include "template.php";
/** @var $conn */?>

<title>Module Register page</title>

<h1 class='text-primary'>Please enter new ESP32 details below</h1>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
    <div class="container-fluid">
        <div class="row">
            <!--Customer Details-->

            <div class="col-md-12">
                <h2>Module details</h2>
                <p>Please enter the new Module location, Module name and APIkey:</p>
                <p>Location<input type="text" name="Location" class="form-control" required="required"></p>
                <p>Module<input type="text" name="Module" class="form-control" required="required"></p>
                <p>API key<input type="password" name="APIkey" class="form-control" required="required"></p>
            </div>
        </div>
    </div>
    <input type="submit" name="formSubmit" value="Submit">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $location = ($_POST['Location']);
    $module = ($_POST['Module']);
    $APIkey = ($_POST['APIkey']);
    $hashed_APIkey = password_hash($APIkey, PASSWORD_DEFAULT);
    //echo  $location;
    //echo  $module;
    //echo  $hashed_APIkey;

// check Module and location in database
    $query = $conn->query("SELECT COUNT(*) FROM `RegisteredModules` WHERE Location='$location'");
    $query2 = $conn->query("SELECT COUNT(*) FROM `RegisteredModules` WHERE Module='$module'");
    $data = $query->fetch();
    $data2 = $query2->fetch();
    $checkModule = (int)$data[0];
    $checkLocation = (int)$data2[0];

    if ($checkModule > 0 && $checkLocation > 0) {
        echo "This Module is already in use at this location";
    } else {
        $sql = "INSERT INTO `RegisteredModules` (Location, Module, HashedAPIKey, Enabled) VALUES (:newLocation, :newModule, :newHashedAPIkey, :enabled)";

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':newLocation', $location);
        $stmt->bindValue(':newModule', $module);
        $stmt->bindValue(':newHashedAPIkey', $hashed_APIkey);
        $stmt->bindValue(':enabled', 1);

        $stmt->execute();
        //$_SESSION["flash_message"] = "Module Created";
        //header("Location:index.php");
    }

}
?>

<?php echo outputFooter(); ?>