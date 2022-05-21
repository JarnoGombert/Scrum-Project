<?php
class User
{
    public $id;
    public $firstName;
    public $lastName;
    public $email;
    public $password;
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
        $this->db->query("INSERT INTO users (firstName, lastName, email, password) VALUES ('$this->firstName', '$this->lastName', '$this->email', '$this->password')");
        return "Gebruiker is toegevoegd";
    }

    function update(){
        $this->db->query("UPDATE users SET firstName='$this->firstName', lastName='$this->lastName', email='$this->email', password='$this->password' WHERE id=$this->id");
        return "Gebruiker is bijgewerkt";
    }

    function delete(){
        $this->db->query("DELETE FROM users WHERE id=$this->id");
        return "Gebruiker is verwijderd";
    }
}