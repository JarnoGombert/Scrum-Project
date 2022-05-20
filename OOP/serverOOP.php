<?php
include 'models/User.php';

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
    $newCustomer->email = $_POST['email'];
    $newCustomer->password = $_POST['password'];

    $_SESSION['message'] = $newCustomer->save();

    header('location: indexOOP.php');
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $user = new User();
    $user = $user->getUser($id);

    $user->firstName = $_POST['firstName'];
    $user->lastName = $_POST['lastName'];
    $user->email = $_POST['email'];
    $user->password = $_POST['password'];

    $_SESSION['message'] = $user->update();
    header('location: indexOOP.php');
}

if (isset($_GET['del'])) {
    $id = $_GET['del'];

    $user = new User();
    $user = $user->getUser($id);

    $_SESSION['message'] = $user->delete();
    header('location: indexOOP.php');
}