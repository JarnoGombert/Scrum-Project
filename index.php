<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Harry B.V.</title>
    <link rel="icon" href="image/Gereedschap.png">
</head>
<body>
    
</body>
</html>
<?php
include "header.php";
$user = null;
    if (isset($_POST['login']))
    {
        $user = getUser($_POST['email'], $_POST['wachtwoord']);
        // hier wordt de eigenaar gecheckt of hij toestemming heeft tot alle bestemmingen

        if($user != 'No user found') {

            // en dan wordt hij doorgestuurd naar de resultaten
            header("Location: ./invoeg.php");
            exit;
        }
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
<section>
    <div class="page">
        <div class="home">
            <h1><a style="text-decoration: none; color: black;" href="#">Beheer</a></h1> 
            <h4>Inloggen</h4>
        </div>    
        <div class="inloggen">
            <form action="#" method="POST">
                <table>
                    <tr>
                        <td><label for="">E-mail</label></td>
                        <td><input name="email" type="email" required></td>
                    </tr>
                    <tr>
                        <td><label for="">Wachtwoord</label></td>
                        <td style="display: flex; align-items: center; margin-left: 20px;"><input name="wachtwoord" class="input" id="Inputt" type="password" required> <input type="checkbox" name="Inputt" onclick="myFunction()"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input name="login" type="submit" value="Login" class="btn"></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</section>
<?php
include "footer.php";
?>   
<script>
    // Dit is voor het wachtwoord checken met een checkbox
function myFunction() {
  var x = document.getElementById("Inputt");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}  
</script>
</body>
</html>




