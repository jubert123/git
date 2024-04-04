<?php
if (!empty($_POST["add_record"])) {
    require_once("database.php");

    $sql = "INSERT INTO users (firstname, lastname, birthdate, phone_number, address) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "sssss", $_POST['firstname'], $_POST['lastname'], $_POST['birthdate'], $_POST['phone_number'], $_POST['address']);

    $result = mysqli_stmt_execute($stmt);

    if (!empty($result)) {
        header('location:users.php');
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>
<html>

<head>
    <title>Add New Record</title>

    <link rel="stylesheet" href="addusers.css">

</head>

<body>
    <div style="margin:20px 0px;text-align:center;"><a href="users.php" class="button_link">Back to List</a></div>
    <section>
        <div class="frm-add">
            <h1 class="demo-form-heading">Add New Record</h1>
            <form name="frmAdd" action="" method="POST">
                <div class="demo-form-row">
                    <label>First Name: </label><br>
                    <input type="text" name="firstname" class="demo-form-field" required />
                </div>

                <div class="demo-form-row">
                    <label>Last Name: </label><br>
                    <input type="text" name="lastname" class="demo-form-field" required />
                </div>

                <div class="demo-form-row">
                    <label>Birthdate: </label><br>
                    <input type="date" name="birthdate" class="demo-form-field" required />
                </div>

                <div class="demo-form-row">
                    <label>Phone Number: </label><br>
                    <input type="tel" pattern="[0-9]{4}-[0-9]{3}-[0-9]{4}" required name="phone_number" class="demo-form-field" required />
                    <br>
                    <span class="phoneformat"> Phone number format: xxxx-xxx-xxxx </span>
                    <br>
                </div>

                <div class="demo-form-row">
                    <label>Address: </label><br>
                    <textarea name="address" class="demo-form-field" rows="5" required></textarea>
                </div>

                <div class="demo-form-row">
                    <input name="add_record" type="submit" value="Add" class="demo-form-submit" style="border-radius: 6px">
                </div>
            </form>
        </div>
    </section>
</body>

</html>
