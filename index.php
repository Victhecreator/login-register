
<?php
session_start();

if(isset($_POST["submit"])) {
    session_destroy();
    header("Location: login.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>User dashboard</title>
</head>
<body>
<div class="container">
        <div class="box">
            <h1>Dashboard</h1>   
            
            <form action="index.php" method="post">
                <div class="form-btn">
                    <input type="submit" class="btn" value="Logout" name="submit">
                </div>
            </form>  
        </div>
    </div>
</body>
</html>