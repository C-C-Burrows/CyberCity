<?php include "template.php"; ?>
<title>Cyber City - Login</title>
<h1 class='text-primary'>Please Login</h1>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h2>Account Details</h2>
                <p>Please enter your username and password:</p>
                <p>User Name<input type="text" name="username" class="form-control" required="required"></p>
                <p>Password<input type="password" name="password" class="form-control" required="required"></p>
            </div>
        </div>
    </div>
    <input type="submit" name="formSubmit" value="Submit">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = sanitise_data($_POST['username']);
    $password = sanitise_data($_POST['password']);
    
}

?>














