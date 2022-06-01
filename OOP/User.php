<?php
include '../database.php';
class User
{
    public $id;
    public $firstName;
    public $lastName;
    public $pc;
    public $place;
    public $street;
    public $houseNr;
    public $phoneNr;
    public $email;
    public $password; //moet weg
    public $notes;
    private $db;

    function __construct()
    {
        $this->db = new mysqli('DB_HOST', 'DB_USER', '', 'DB_NAME');
    }

    public function getUser($id){
        $user = $this->db->query("SELECT * FROM users WHERE id = " . $id);
        if($user->num_rows > 0){
            $userArray = $user->fetch_array();
            $foundUser = new User();

            $foundUser->id = $userArray['id'];
            $foundUser->firstName = $userArray['firstName'];
            $foundUser->lastName = $userArray['lastName'];
            $foundUser->email = $userArray['email'];
            $foundUser->password = $userArray['password'];

            return $foundUser;
        }else{
            return "No User found";
        }
    }


    function save(){
//        $this->db->query("INSERT INTO klant (firstName, lastName, email, password) VALUES ('$this->firstName', '$this->lastName', '$this->email', '$this->password')");
        $this->db->query("INSERT INTO `klant` (`VoorNaam`, `AchterNaam`, `Postcode`, `Plaats`, `Straat`, `Huis_Nr`, `Tel_Nr`, `Email`, `Notities`) 
VALUES ('$this->firstName', '$this->lastName', '$this->pc', '$this->place', '$this->street', '$this->houseNr', '$this->phoneNr', '$this->email', '$this->notes')");
        return "Gebruiker is toegevoegd";
    }


    function update(){
//        $this->db->query("UPDATE klant SET firstName='$this->firstName', lastName='$this->lastName', email='$this->email', password='$this->password' WHERE id=$this->id");
        $this->db->query("UPDATE `klant` SET `VoorNaam` = '$this->firstName', `AchterNaam` = '$this->lastName', `Postcode` = '$this->pc', `Plaats` = '$this->place', 
                   `Straat` = '$this->street', `Huis_Nr` = '$this->houseNr', `Tel_Nr` = '$this->phoneNr', `Email` = '$this->email', `Notities` = '$this->notes' WHERE `klant`.`Klant_ID` = '$this->id'");
        return "Gebruiker is bijgewerkt";
    }

    function delete(){
        $this->db->query("DELETE FROM klant WHERE Klant_ID='$this->id'");
        return "Gebruiker is verwijderd";
    }
}