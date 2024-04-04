<?php
require_once("database.php");
?>

<html>
<head>
    <title>Gin Ubra Ni ni Bryan Pramis!</title>
    <link rel="stylesheet" href="users.css">
</head>

<body>
    <?php
    // Use the existing MySQLi connection
    $pdo_statement = $conn->prepare("SELECT * FROM users ORDER BY ID DESC");
    $pdo_statement->execute();
    $result = $pdo_statement->get_result();
    ?>
    <section>
        <div style="text-align:center;margin:20px 0px;">
            <a href="index.php" class="button_link" title="AddNew" style="vertical-align:bottom;">Return To Homepage</a>
        </div>
        <div style="text-align:center;margin:20px 0px;">
            <a href="addusers.php" class="button_link">
                <img src="images/add.png" title="Add New" style="vertical-align:bottom;" /> Add New Record
            </a>
        </div>
    </section>

    <table class="tbl-qa">
    <thead>
    <tr>
        <th class="table-header" width="15%">First Name</th>
        <th class="table-header" width="15%">Last Name</th>
        <th class="table-header" width="25%">Birthdate</th>
        <th class="table-header" width="20%">Email</th> 
        <th class="table-header" width="40%">Phone Number</th>
        <th class="table-header" width="15%">Address</th>
        <th class="table-header" width="15%">Password</th>
        <th class="table-header" width="10%"></th>
    </tr>
</thead>
        <tbody id="table-body">
            <?php
            if (!empty($result)) {
                while ($row = $result->fetch_assoc()) {
            ?>
                    <tr class="table-row">
                <td><?php echo $row["firstname"]; ?></td>
                <td><?php echo $row["lastname"]; ?></td>
                <td><?php echo $row["birthdate"]; ?></td>
                <td><?php echo $row["email"]; ?></td>
                <td><?php echo $row["phone_number"]; ?></td>
                <td><?php echo $row["address"]; ?></td>
                <td><?php echo $row["password"]; ?></td>
                <td>
                    <a class="row_button_link" href='edituser.php?ID=<?php echo $row['ID']; ?>'><img src="images/edit.png" title="Edit" /></a>
                    <a class="row_button_link" href='deleteuser.php?ID=<?php echo $row['ID']; ?>'><img src="images/delete.png" title="Delete" /></a>
                </td>
            </tr>
            <?php
                }
            }
            ?>
        </tbody>
    </table>
</body>

</html>
