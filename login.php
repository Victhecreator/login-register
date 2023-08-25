<?php
session_start();
// if(isset($_SESSION["user"])){
//     header("location: index.php");
//     exit();
// }
if(isset($_POST["submit"])) {
  $email = $_POST["email"];
  $password = $_POST["password"];


  require_once "db.php";

  $sql = "SELECT * FROM user WHERE email = :email";
  $stmt = $conn->prepare( $sql);
  $stmt->bindParam(':email', $email);
  $stmt->execute();
  $user = $stmt->fetch(PDO::FETCH_ASSOC);
//$user = mysqli_fetch_assoc($result);

//   $result = $stmt->fsetFetchMode(PDO::FETCH_ASSOC);

  if($user) {
    if(password_verify($password, $user["password"])) {
        $_SESSION["user"] = "yes";
        echo '<div class="alert-success">Login successful</div>';
        header("location: index.php");
        exit();
    } else {
        echo '<div class="alert">Incorrect password</div>';
    }
} else {
    echo '<div class="alert">Email does not exist</div>';
}

//   mysqli_stmt_close($stmt);
}
?>

            
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>
<body>
    <div class="container">
        <div class="box">
            <h1>Login</h1>

           
            <form action="login.php" method="post">
                <div class="form-group">
                    <input type="text" name="email" placeholder="Email" class="form-control">
                </div>
                <div class="form-group">
                    <input type="password" name="password" placeholder="Password" class="form-control">
                </div>
                <div class="form-btn">
                    <input type="submit" class="btn" value="Login" name="submit">
                    <p class= "para">Don't have an account! <a href="registration.php">Register</a></p>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
