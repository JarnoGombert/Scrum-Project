<?php
include 'database.php';
function db_connect()
{
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    return $mysqli;
}
    
function db_getData($query)
{
    $mysqli = db_connect();
    $result = $mysqli->query($query);
    $mysqli->close();
    return $result;
}

function db_insertData($query)
{
    $mysqli = db_connect();
    $result = $mysqli->query($query);
    if ($result === TRUE) 
    {
       // Return row id for succes
        return mysqli_insert_id($mysqli);
    } 
    else 
    {
        $result = "Error: " . $query . "<br>" . $mysqli->error;
     }
    $mysqli->close();
    return $result;
}

function getUser($email,$password)
{
    $user = db_getData("SELECT * FROM `beheerder` WHERE `Email` = '$email' AND `Wachtwoord` = '$password'");
    //PDO: rowCount
    if ($user->num_rows >0)
    {
        header("Location: ./invoeg.php");
        // User found, return user data
        return $user;
    }
    else
    {
        return "No user found";
    }
}

?>