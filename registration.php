<?php

require_once "db.php";

if(isset($_POST["submit"])) {
    $fullName = $_POST["fullname"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $repeatPassword = $_POST["repeat_password"];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $errors = array();

    // Check for empty fields
    if(empty($fullName) || empty($email) || empty($password) || empty($repeatPassword)) {
       array_push($errors, "All fields are required");
    }

    // Validate email format
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
       array_push($errors, "Email is not valid");
    }

    // Check password length
    if(strlen($password) < 8) {
       array_push($errors, "Password must be greater than 8 characters");
    }

    // Check if passwords match
    if($password !== $repeatPassword) {
        array_push($errors, "Passwords do not match");
    }

                

    $stmt = $conn->prepare("SELECT * FROM user WHERE email = ?");
    $stmt->execute([$email]);
    $rowCount = $stmt->rowCount();

    if($rowCount > 0){
        array_push($errors, "Email already exists!");
    }


    // Display errors
    if(count($errors) > 0) {
        echo '<div class="alert">';
        foreach($errors as $error) {
          echo '<p>' . $error . '</p>';
        }
        echo '</div>';
    } else {

        $stmt = $conn->prepare("INSERT INTO user (full_name, email, password) VALUES (?, ?, ?)");
        if ($stmt->execute([$fullName, $email, $hashedPassword])) {
        echo '<div class="alert-success">Registration successful</div>';
        } else {
            echo '<div class="alert">Registration failed</div>';
        }
     }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Registration</title>
</head>
<body>
    <div class="container">
        <div class="box">
            <h1>Registration</h1>
           
            <form action="registration.php" method="post">
                <div class="form-group">
                    <input type="text" name="fullname" placeholder="Fullname">
                </div>
                <div class="form-group">
                    <input type="text" name="email" placeholder="Email">
                </div>
                <div class="form-group">
                    <input type="password" name="password" placeholder="Password">
                </div>
                <div class="form-group">
                    <input type="password" name="repeat_password" placeholder="Repeat Password">
                </div>
                <div class="form-btn">
                    <input type="submit" class="btn" value="Register" name="submit">
                    <p class= "para">Already have an account! <a href="login.php">Login</a></p>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
