<!-- hier include ik de database defines -->
<?php
include 'database.php';

function db_connect()
{
    try {
        $dbString = "mysql:host=".DB_HOST.";dbname=".DB_NAME;

        $db = new PDO($dbString, DB_USER, DB_PASSWORD);
        // set the PDO error mode to exception
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $db;
      } catch(PDOException $e) {
        die("Connection failed: " . $e->getMessage());
      }
}

function db_getData($query)
{
    $DB = db_connect();
    $result = $DB->query($query);
    $DB = null;
    return $result;
} 

function db_insertData($query) {
    try{
        $db = db_connect();
        $queryPDO = $db->prepare($query);
        $queryPDO->execute();
        $db = null;
        return $queryPDO;
    } catch(PDOException $e) {
        die("Error: " . $e->getMessage());
    }
}

function getUser($email,$password)
{
    $user = db_getData("SELECT * FROM beheerder WHERE E-mail = '$email' AND Wachtwoord = '$password'");
    //PDO: rowCount
    if ($user->rowCount() > 0 )
    {
        // User found, return user data
        return $user;
    }
    else
    {
        return "No user found";
    }
}

?>