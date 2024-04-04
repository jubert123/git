<?php
require_once("database.php");
if (!empty($_POST["save_record"])) {
    $pdo_statement = $pdo_conn->prepare("update tbl_lirio set   fistname='" . $_POST['fistname'] . "',      lastname='" . $_POST['lastname'] . "',      birthdate='" . $_POST['birthdate'] . "',     phone_number='" . $_POST['phone_number'] . "',      address='" . $_POST['address']);
    $result = $pdo_statement->execute();
    if ($result) {
        header('location:users.php');
    }
}
$pdo_statement = $pdo_conn->prepare("SELECT * FROM users where ID=" . $_GET["ID"]);
$pdo_statement->execute();
$result = $pdo_statement->fetchAll();
?>
<html>

<head>
    <title>Edit Record</title>

    <link rel="stylesheet" href="edit.css">

</head>

<body>
    <div style="margin:20px 0px;text-align:center;"><a href="index.php" class="button_link">Back to List</a></div>
    <section>
        <div class="frm-add">
            <h1 class="demo-form-heading">Edit Record</h1>
            <form name="frmAdd" action="" method="POST">

                <div class="demo-form-row">
                    <label>First Name: </label><br>
                    <input type="text" name="firstname" class="demo-form-field" value="<?php echo $result[0]['firstname']; ?>" required />
                </div>

                <div class="demo-form-row">
                    <label>Last Name: </label><br>
                    <input type="text" name="lastname" class="demo-form-field" value="<?php echo $result[0]['lastname']; ?>" required />
                </div>

                <div class="demo-form-row">
                    <label>Birthdate: </label><br>
                    <input type="date" name="birthdate" class="demo-form-field" value="<?php echo $result[0]['birthdate']; ?>" required />
                </div>

                <div class="demo-form-row">
                    <label>Email: </label><br>
                    <input type="email" name="email" class="demo-form-field" value="<?php echo $result[0]['email']; ?>" required />
                </div>


                <div class="demo-form-row">
                    <label>Address: </label><br>
                    <textarea name="address" class="demo-form-field" rows="5" required><?php echo $result[0]['address']; ?></textarea>
                </div>

                <div class="demo-form-row">
                    <label>Phone Number: </label><br>
                    <input type="tel" pattern="[0-9]{4}-[0-9]{3}-[0-9]{4}" required name="phone_number" class="demo-form-field" value="<?php echo $result[0]['phone_number']; ?>" required />
                    <br>
                    <span class="phoneformat"> Phone number format: xxxx-xxx-xxxx </span>
                    <br>
                </div>

                <div class="demo-form-row">
                    <input name="save_record" type="submit" value="Save" class="demo-form-submit">
                </div>

            </form>
        </div>
</body>

</section>

</html>