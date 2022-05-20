
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
include "header.php";
include "db_functions.php";
$db = new mysqli('localhost', 'root', '', 'gertdatabase');
$results = $db->query("SELECT * FROM klant");
?>
<div class="content">
    <table>
        <thead>
        <tr>
            <th>Voornaam</th>
            <th>Achternaam</th>
            <th>Email</th>
            <th colspan="2">Action</th>
        </tr>
        </thead>

        <?php while ($row = $results->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['firstName']; ?></td>
                <td><?php echo $row['lastName']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td>
                    <a href="/php/crud/oop/indexOOP.php?edit=<?php echo $row['id']; ?>" class="edit_btn" >Edit</a>
                </td>
                <td>
                    <a href="/php/crud/oop/serverOOP.php?del=<?php echo $row['id']; ?>" class="del_btn">Delete</a>
                </td>
            </tr>
        <?php } ?>
    </table>

    <form method="post" action="serverOOP.php">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="input-group">
            <label>Voornaam</label>
            <input type="text" name="firstName" value="<?php echo $firstName; ?>">
        </div>
        <div class="input-group">
            <label>Achternaam</label>
            <input type="text" name="lastName" value="<?php echo $lastName; ?>">
        </div>
        <div class="input-group">
            <label>Email</label>
            <input type="email" name="email" value="<?php echo $email; ?>">
        </div>
        <div class="input-group">
            <label>Wachtwoord</label>
            <input type="password" name="password" value="<?php echo $password; ?>">
        </div>
        <div class="input-group">
            <?php if ($update == true): ?>
                <button class="btn" type="submit" name="update" style="background: #556B2F;" >update</button>
            <?php else: ?>
                <button class="btn" type="submit" name="save" >Save</button>
            <?php endif ?>
        </div>
    </form>
</div>
<?php
include "footer.php";
?>
</body>
</html>