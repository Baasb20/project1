<?php

// hier wordt er met de "include" een connectie gemaak naar de andere files.
include 'database.php';
include 'HelperFunctions.php';

// met de isset functie wordt gekeken of POST array, wel de variabele post of niet.
if(isset($_POST['submit'])){

  // hier wordt er een array gemaakt, met alle name attributes.
  $fields = [
    	"username",
      "firstname",
      "lastname",
      "password",
      "email"
  ];

$obj = new HelperFunctions();
$no_error = $obj->has_provided_input_for_required_fields($fields);

  // wat er hier gebeurt is, op het moment dat er geen error is in input fields.De gegevens worden gestuur naar de database.
  if($no_error){
    $username = $_POST['username'];
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname = $_POST['lastname'];
    $password =$_POST['password'];
    $email = $_POST['email'];

    $db = new database('localhost', 'root', '', 'project1', 'utf8');
    $db->create_or_update_user($username, $firstname, $middlename, $lastname, $password, $email);
    }
};

?>

<html>
    <body>
        <h1>Sign Up</h1>
        <form method="post" action="signup.php" accept-charset="UTF-8">
            <input type="text" name="firstname" placeholder="Vul in uw gebruikersnaam" required><br>
            <input type="text" name="middlename" placeholder="Vul in uw tussenvoegsel"><br>
            <input type="text" name="lastname" placeholder="Vul in uw achternaam" required><br>
            <input type="email" name="email" placeholder="Vul in uw email" required><br>
            <input type="text" name="username" placeholder="Vul in uw gebruikersnaam" required><br>
            <input type="password" name="password" placeholder="Vul in uw wachtwoord" required><br>
            <input type="password" name="passwordrepeat" placeholder="Vul in uw wachtwoord nogmaals " required><br>
            <input type="submit" name="submit" href="index.php">
        </form>
    </body>
</html>
