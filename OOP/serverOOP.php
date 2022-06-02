<?php
include 'User.php';

session_start();

// initialize variables
$firstName = "";
$lastName = "";
$email = "";
$password = "";
$id = 0;
$update = false;

if (isset($_POST['save'])) {
    $newCustomer = new User();

    $newCustomer->firstName = $_POST['firstName'];
    $newCustomer->lastName = $_POST['lastName'];
    $newCustomer->pc = $_POST['pc'];
    $newCustomer->place = $_POST['place'];
    $newCustomer->street = $_POST['street'];
    $newCustomer->houseNr = $_POST['houseNr'];
    $newCustomer->phoneNr = $_POST['phoneNr'];
    $newCustomer->email = $_POST['email'];
    $newCustomer->notes = htmlspecialchars($_POST['notes']);

    $_SESSION['message'] = $newCustomer->save();

    header('location: ../invoeg.php');
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $user = new User();
    $user = $user->getUser($id);

//    $user->firstName = $_POST['firstName'];
//    $user->lastName = $_POST['lastName'];
//    $user->email = $_POST['email'];
//    $user->password = $_POST['password'];

    $user->firstName = $_POST['firstName'];
    $user->lastName = $_POST['lastName'];
    $user->pc = $_POST['pc'];
    $user->place = $_POST['place'];
    $user->street = $_POST['street'];
    $user->houseNr = $_POST['houseNr'];
    $user->phoneNr = $_POST['phoneNr'];
    $user->email = $_POST['email'];
    $user->notes = htmlspecialchars($_POST['notes']);

    $_SESSION['message'] = $user->update();
    header('location: ../invoeg.php');
}

if (isset($_GET['del'])) {
    $id = $_GET['del'];

    $user = new User();
    $user = $user->getUser($id);

    $_SESSION['message'] = $user->delete();
    header('location: ../invoeg.php');
}
