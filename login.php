<?php 
session_start(); // starte session um variablen seitenuebergreifend zu speichern
$pdo = new PDO('mysql:host=localhost;dbname=gfn_uebung', 'root', ''); // Erstelle API (PDO) zur Database gfn_uebung
 
if(isset($_GET['login'])) { // login wird mit dem wert 1 generiert wenn der user auf den button klickt, dies ist das zeichen das script zu starten
    $email = $_POST['email']; // $_GET holt daten die per url uebergeben werden, $_POST holt daten die per formular uebergeben werden.
    $password = $_POST['password']; // holt den wert der im formular unter password abgespeichert ist
    
    $statement = $pdo->prepare("SELECT * FROM users WHERE email = :email"); // bereite ein sql statement vor
    $result = $statement->execute(array('email' => $email)); // fuehre statement aus, prueft ob email in database vorhanden
    $user = $statement->fetch(); // speichere den user (falls vorhanden) in $user
        
    //Überprüfung des Passworts
    if ($user !== false && password_verify($password, $user['password'])) { //falls user vorhanden, fuehre password_verify aus, if password_verify = true 
        $_SESSION['userid'] = $user['id']; // weise der session user id die id des users aus der sql tabelle zu
        die('Login erfolgreich. Weiter zum <a href="http://localhost/GFN_Projects/php_Eigenarbeit/protected_page.php">internen Bereich.</a>'); // die = exit function / end script
    } else {
        $errorMessage = "E-Mail oder Passwort war ungültig<br>"; // falls ein fehler aufgetreten is speichere eine fehlermeldung in $errorMessage
    }
    
}
?>

<!DOCTYPE html> 
<html> 
<head>
	<link rel="stylesheet" href="resources/default.css">
  	<title>Login</title>    
</head> 
<body>
 
<?php 
if(isset($errorMessage)) { // falls ein error entstanden ist wurde dieser $errorMessage zugewiesen (isset = is set)
    echo $errorMessage;
}
?>
<h3>Login</h3>

<form action="?login=1" method="post">
E-Mail:<br>
<input type="email" size="40" maxlength="250" name="email"><br><br>
 
Dein Passwort:<br>
<input type="password" size="40"  maxlength="250" name="password"><br>
 
<input type="submit" value="Login">
</form> 

<br>
<a href="http://localhost/GFN_Projects/php_Eigenarbeit/home.php">Home</a>

</body>
</html>