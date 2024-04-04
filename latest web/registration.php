<?php
session_start();
if (isset($_SESSION["user"])) {
   header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<style>
   
</style>
<body>
    <div class="container">
        <?php
        if (isset($_POST["submit"])) {
            $firstName = $_POST["firstname"];
            $lastName = $_POST["lastname"];
            $birthdate = $_POST["birthdate"];
            $email = $_POST["email"];
            $phone_number = $_POST["phone_number"];
            $address = $_POST["address"];
            $password = $_POST["password"];
            $passwordRepeat = $_POST["repeat_password"];
           
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            $errors = array();
           
            if (empty($firstName) || empty($lastName) || empty($birthdate) || empty($email) || empty($phone_number) || empty($address) || empty($password) || empty($passwordRepeat)) {
                array_push($errors, "All fields are required");
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                array_push($errors, "Email is not valid");
            }
            if (strlen($password) < 8) {
                array_push($errors, "Password must be at least 8 characters long");
            }
            if ($password !== $passwordRepeat) {
                array_push($errors, "Password does not match");
            }
            require_once "database.php";
            $sql = "SELECT * FROM users WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);
            $rowCount = mysqli_num_rows($result);
            if ($rowCount > 0) {
                array_push($errors, "Email already exists!");
            }
            if (count($errors) > 0) {
                foreach ($errors as  $error) {
                    echo "<div class='alert alert-danger'>$error</div>";
                }
            } else {
                $sql = "INSERT INTO users (firstname, lastname, birthdate, email, phone_number, address, password) VALUES (?, ?, ?, ?, ?, ?, ?)";

                $stmt = mysqli_stmt_init($conn);
                $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
                if ($prepareStmt) {
                    mysqli_stmt_bind_param($stmt, "sssssss", $firstName, $lastName, $birthdate, $email, $phone_number, $address, $password);

                    mysqli_stmt_execute($stmt);
                    echo "<div class='alert alert-success'>You are registered successfully.</div>";
                } else {
                    die("Something went wrong");
                }
            }
        }
        ?>
        <div class="container">
        <div class="logo-container">
            <img src="logo.jpeg" alt="Logo" class="logo">
        </div>

        <form action="registration.php" method="post">
            <div class="form-group">
                <input type="text" class="form-control" name="firstname" placeholder="First Name">
            </div><br>
            <div class="form-group">
                <input type="text" class="form-control" name="lastname" placeholder="Last Name">
            </div><br>
            <div class="form-group">
                <input type="date" class="form-control" name="birthdate" placeholder="Birthdate">
            </div><br>
            <div class="form-group">
                <input type="email" class="form-control" name="email" placeholder="Email">
            </div><br>
            <div class="form-group">
                <input type="tel" class="form-control" name="phone_number" placeholder="Phone Number">
            </div><br>
            <div class="form-group">
                <textarea class="form-control" name="address" placeholder="Address" rows="4"></textarea>
            </div><br>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Password">
            </div><br>
            <div class="form-group">
                <input type="password" class="form-control" name="repeat_password" placeholder="Repeat Password">
            </div><br>
            <div class="form-btn">
                <input type="submit" class="btn btn-primary" value="Register" name="submit">
            </div>
        </form>
        <br>
        <div>
            <p>Already Registered?<p>
            <div class="register-link">
                <a href="login.php">Login Here</a>
            </div>
        </div>
    </div>
</body>
</html>
