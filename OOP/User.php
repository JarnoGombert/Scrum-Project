<?php
//include '../db_functions.php';
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
        $this->db = new mysqli('localhost', 'root', '', 'website');
    }

    public function getUser($id){
        $this->id = $id;
        $user = $this->db->query("SELECT * FROM klant WHERE Klant_ID = '$id'");

        if($user->num_rows > 0){
            $userArray = $user->fetch_array();
            $foundUser = new User();

            $foundUser->id = $userArray['Klant_ID'];
            $foundUser->firstName = $userArray['VoorNaam'];
            $foundUser->lastName = $userArray['AchterNaam'];
            $foundUser->pc = $userArray['Postcode'];
            $foundUser->place = $userArray['Plaats'];
            $foundUser->street = $userArray['Straat'];
            $foundUser->houseNr = $userArray['Huis_Nr'];
            $foundUser->phoneNr = $userArray['Tel_Nr'];
            $foundUser->email = $userArray['Email'];
//            $foundUser->password = $userArray['password'];
            $foundUser->notes = $userArray['Notities'];

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
        $this->db->query("DELETE FROM `klant` WHERE Klant_ID='$this->id'");
        return "Gebruiker is verwijderd";
    }


}