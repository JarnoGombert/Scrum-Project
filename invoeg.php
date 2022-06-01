
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
include('OOP/serverOOP.php');

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

<?php if (isset($_SESSION['message'])): ?>
    <div class="msg">
        <?php
        echo $_SESSION['message'];
        unset($_SESSION['message']);
        ?>
    </div>
<?php endif;  
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
            <th>Telefoon-nummer</th>
            <th>Plaats</th>
            <th>Postcode</th>
            <th>Straat</th>
            <th>Huisnummer</th>
            <th colspan="2">Action</th>
        </tr>
        </thead>

        <?php while ($row = $results->fetch_assoc()) { ?>
            <tr class="tabel">
                <td><?php echo $row['VoorNaam']; ?></td>
                <td><?php echo $row['AchterNaam']; ?></td>
                <td><?php echo $row['Email']; ?></td>
                <td><?php echo $row['Tel_Nr']; ?></td>
                <td><?php echo $row['Plaats']; ?></td>
                <td><?php echo $row['Postcode']; ?></td>
                <td><?php echo $row['Straat']; ?></td>
                <td><?php echo $row['Huis_Nr']; ?></td>
                <td>
                    <a href="invoeg.php?edit=<?php echo $row['id']; ?>" class="edit_btn" >Edit</a>
                </td>
                <td>
                    <a href="serverOOP.php?del=<?php echo $row['id']; ?>" class="del_btn">Delete</a>
                </td>
                <td>
                    <a href="mailto:jarnogombert@gmail.com?subject=Klant informatie">Stuur klant informatie</a>
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
            <label>Telefoon-Nummer</label>
            <input type="text" name="password" value="<?php echo $password; ?>">
        </div>
        <div class="input-group">
            <label>Plaats</label>
            <input type="text" name="password" value="<?php echo $password; ?>">
        </div>
        <div class="input-group">
            <label>Postcode</label>
            <input type="text" name="password" value="<?php echo $password; ?>">
        </div>
        <div class="input-group">
            <label>Straat</label>
            <input type="text" name="password" value="<?php echo $password; ?>">
        </div>
        <div class="input-group">
            <label>Huisnummer</label>
            <input type="number" name="password" value="<?php echo $password; ?>">
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