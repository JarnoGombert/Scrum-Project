
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

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $update = true;
    $user = new User();
    $user = $user->getUser($id);
    console_log($id);
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
                    <a href="invoeg.php?edit=<?php echo $row['Klant_ID']; ?>" class="edit_btn" >Edit</a>
                </td>
                <td>
                    <a href="/OOP/serverOOP.php?del=<?php echo $row['Klant_ID']; ?>" class="del_btn">Delete</a>
                </td>
                <td>
                    <a href="mailto:jarnogombert@gmail.com?subject=Klant informatie">Stuur klant informatie</a>
                </td>
            </tr>
        <?php } ?>
    </table>

    <form method="post" action="/OOP/serverOOP.php">
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
            <input type="text" name="phoneNr" value="<?php echo $phoneNr; ?>">
        </div>
        <div class="input-group">
            <label>Plaats</label>
            <input type="text" name="place" value="<?php echo $place; ?>">
        </div>
        <div class="input-group">
            <label>Postcode</label>
            <input type="text" name="pc" value="<?php echo $pc; ?>">
        </div>
        <div class="input-group">
            <label>Straat</label>
            <input type="text" name="street" value="<?php echo $street; ?>">
        </div>
        <div class="input-group">
            <label>Huisnummer</label>
            <input type="number" name="houseNr" value="<?php echo $houseNr; ?>">
        </div>
        <div class="input-group">
            <label>Notities</label>
            <textarea name="notes" cols="87" rows="5"><?php echo $notes; ?></textarea>
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