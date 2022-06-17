<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Harry B.V.</title>
    <link rel="icon" href="image/Gereedschap.png">
</head>
<?php
include "header.php";
include('OOP/serverOOP.php');

$firstName = '';
$lastName = '';
$email = '';
//$password = '';
$phoneNr = '';
$place = '';
$pc = '';
$street = '';
$houseNr = '';
$notes = '';
$werkzaamheid = '';

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $update = true;
    $user = new User();
    $user = $user->getUser($id);
    console_log(htmlspecialchars($user->notes));
    $firstName = $user->firstName;
    $lastName = $user->lastName;
    $email = $user->email;
//    $password = $user->password;

    $phoneNr = $user->phoneNr;
    $place = $user->place;
    $pc = $user->pc;
    $street = $user->street;
    $houseNr = $user->houseNr;
    $notes = $user->notes;
    $werkzaamheid = $user->werkzaamheid;
}
//scuffed php version of console.log
function console_log($output, $with_script_tags = true) {
    $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) .
        ');';
    if ($with_script_tags) {
        $js_code = '<script>' . $js_code . '</script>';
    }
    echo $js_code;
}
?>

<body>
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
    <div style="overflow-x:auto;">
        <table id="info">
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
                <th>Informatie sturen</th>
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
                    <td style="display: none;"><?php echo $row['Notities']; ?></td>
                    <td>
                        <a href="invoeg.php?edit=<?php echo $row['Klant_ID']; ?>" class="edit_btn" >Bewerk</a>
                    </td>
                    <td>
                        <a href="./OOP/serverOOP.php?del=<?php echo $row['Klant_ID']; ?>" class="del_btn">Verwijder</a>
                    </td>
                    <td>
                        <a class="mail_link" href="mailto:jarnogombert@gmail.com?subject=Klant informatie&body=Harry B.V.%0D%0AKlant Informatie %0D%0A%0D%0ANaam: <?php echo $row['VoorNaam']. ""; ?> <?php echo $row['AchterNaam']. "%0D%0A";?>E-mail: <?php echo $row['Email']. "%0D%0A";?>Tel: <?php echo $row['Tel_Nr']. "%0D%0A";?>Woonplaats: <?php echo $row['Plaats']. "";?> <?php echo $row['Postcode']. "%0D%0A";?>Adres: <?php echo $row['Straat']. "";?> <?php echo $row['Huis_Nr']. "%0D%0A";?>Werkzaamheid: <?php echo $row['Werkzaamheid']. "%0D%0A"; ?>Notities: <?php echo $row['Notities']. ".%0D%0A%0D%0A"; ?>">Stuur klant informatie</a>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
    

    <form method="post" action="./OOP/serverOOP.php">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="input-group">
            <label>Voornaam</label>
            <input type="text" name="firstName" value="<?php echo $firstName; ?>" required>
        </div>
        <div class="input-group">
            <label>Achternaam</label>
            <input type="text" name="lastName" value="<?php echo $lastName; ?>">
        </div>
        <div class="input-group">
            <label>Email</label>
            <input type="email" name="email" value="<?php echo $email; ?>" required>
        </div>
        <div class="input-group">
            <label>Telefoon-Nummer</label>
            <input type="text" name="phoneNr" value="<?php echo $phoneNr; ?>">
        </div>
        <div class="input-group">
            <label>Plaats</label>
            <input type="text" name="place" value="<?php echo $place; ?>" required>
        </div>
        <div class="input-group">
            <label>Postcode</label>
            <input type="text" name="pc" value="<?php echo $pc; ?>" required>
        </div>
        <div class="input-group">
            <label>Straat</label>
            <input type="text" name="street" value="<?php echo $street; ?>" required>
        </div>
        <div class="input-group">
            <label>Huisnummer</label>
            <input type="number" name="houseNr" value="<?php echo $houseNr; ?>" required>
        </div>
        <div class="input-group">
        <label>Werkzaamheden</label>
        <select id="werkzaamheden" name="activities">
            <option value="<?php echo $werkzaamheid; ?>"><?php echo $werkzaamheid; ?></option>
            <option value="repareren">repareren</option>
            <option value="onderhoud">onderhoud</option>
            <option value="vervangen ">vervangen </option>
            <option value="plaatsen">plaatsen</option>
        </select>
        </div>
        <div class="input-group">
            <label>Notities</label>
            <textarea name="notes" class="comment"><?php echo $werkzaamheid; ?> <?php echo $notes; ?></textarea>
        </div>
        <div class="input-group">
            <?php if ($update == true): ?>
                <button class="btn2" type="submit" name="update">update</button>
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