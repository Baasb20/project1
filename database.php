<?php
//hier wordt een class database aan gemaakt
class database{

  // hier worden private variables gemaakt
  private $host;
  private $db;
  private $user;
  private $password;
  private $charset;
  private $pdo;

  // met de construct kan je object initialiseren
  public function __construct($host, $user, $password, $db, $charset){
    $this->host = $host;
    $this->user = $user;
    $this->pass = $password;
    $this->charset = $charset;

    try {
        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        $this->pdo = new PDO($dsn, $user, $password, $options);
    } catch (\PDOException $e) {
        echo $e->getMessage();
        throw $e;
    }
  }

  private function create_or_update_account($email, $password, $username){

    // hier wordt er in de table account gegevens ingevuld
    $query = "INSERT INTO account
          (email, password, username)
          VALUES
          (:email, :password, :username)";

    // hier wordt de statement voorbereid om data in de database te zetten
    $statement = $this->pdo->prepare($query);

    // hier wordt de wachtwoord van de gebruiker gehashd
    $hashed_password =  password_hash($password, PASSWORD_DEFAULT);

    //hier wordt de statement uitgevoerd
    $statement->execute(['email'=>$email, 'password'=>$hashed_password, 'username'=>$username]);

    // hier wordt de laatste "insert" id gereturnd
    $account_id = $this->pdo->lastInsertId();
    return $account_id;
  }

  private function create_or_update_persoon($username, $firstname, $middlename, $lastname, $account_id){

    // hier wordt er in de table account gegevens ingevuld
    $query = "INSERT INTO persoon
          (account_id, firstname, middlename, lastname)
          VALUES
          (:account_id, :firstname, :middlename, :lastname)";

    // hier wordt de statement voorbereid om data in de database te zetten
    $statement = $this->pdo->prepare($query);

    //hier wordt de statement uitgevoerd
    $statement->execute(['account_id'=>$account_id, 'firstname'=>$firstname, 'middlename'=>$middlename, 'lastname'=>$lastname ]);

    // hier wordt de laatste "insert" id gereturnd
    $persoon_id = $this->pdo->lastInsertId();
    return $persoon_id;
  }

  public function create_or_update_user($username, $firstname, $middlename, $lastname, $password, $email){

    try{
      // hier begint een database transaction
      $this->pdo->beginTransaction();

      $account_id = $this->create_or_update_account($email, $password, $username);

      $this->create_or_update_persoon($username, $firstname, $middlename, $lastname, $account_id);

      $this->pdo->commit();

      //op het moment wanneer een gebruiker zich registreert wordt de gebruiker geredirect naar index.php
      header("location:index.php");
      exit();

    // hier wordt er gerolled back als er iets fout gaat
    }catch(Exception $e){
      $this->pdo->rollback();
      throw $e;
    }
  }

  public function authenticate_user($username,$password){
    // maak een statement object op basis van de mysql query en sla deze op in $stmt
    $query = "SELECT password FROM account WHERE username = :username";
    $stmt = $this->pdo->prepare($query);

    // prepared statement object will be executed.
    $stmt->execute(['username' => $username]);
    $result = $stmt->fetch();

    // haalt de hashed password value op uit de db dataset
    $hashed_password = $result['password'];

    $authenticated_user = false;

    // hier er gekeken of de username en de wachtwoord van database klopen
    if ($username && password_verify($password, $hashed_password)){
      $authenticated_user = true;
        header('location: welcome.php');
        exit();
    } else {
        echo "invalid username and/or password";
    }
  }
};

?>
