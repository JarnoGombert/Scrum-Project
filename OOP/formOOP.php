<?php
include('serverOOP.php');

$firstName = '';
$lastName = '';
$email = '';
$password = '';

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $update = true;
    $user = new User();
    $user = $user->getUser($id);

    $firstName = $user->firstName;
    $lastName = $user->lastName;
    $email = $user->email;
    $password = $user->password;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>CRUD: CReate, Update, Delete PHP MySQL</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<?php if (isset($_SESSION['message'])): ?>
    <div class="msg">
        <?php
        echo $_SESSION['message'];
        unset($_SESSION['message']);
        ?>
    </div>
<?php endif ?>
<?php
$db = new mysqli('localhost', 'root', '', 'gc_festival');
$results = $db->query("SELECT * FROM users");
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

</body>
</html>