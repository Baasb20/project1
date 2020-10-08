<?php

  include 'database.php';
  include 'helperfunctions.php';

  if($_POST['submit']){

    //Hier wordt een field gemaak met de attributes.
    $fields = [
      	"username",
        "password"
    ];

  $obj = new HelperFunctions();
  $no_error = $obj->has_provided_input_for_required_fields($fields);

    // Als er geen error is, dan worden de gegevens doorgestuurd naar de database.
  if($no_error){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $db = new database('localhost', 'root', '', 'project1', 'utf8');
    $db->authenticate_user($username, $password);
  }
}

?>

<html>
    <body>
        <h1>Login</h1>
        <form>
            <input type="text" name="username" placeholder="Vul in uw gebruikersnaam" required><br>
            <input type="password" name="password" placeholder="Vul in uw wachtwoord"required><br>
            <input type="submit" name="submit"><br>
            Geen account? <a href="signup.php">Sign Up</a><br>
            Wachtwoord vergeten? <a href="lostpsw.php">Reset wachtwoord</a>
        </form>
    </body>
</html>
