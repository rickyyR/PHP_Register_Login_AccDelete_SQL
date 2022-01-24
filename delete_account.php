<?php
session_start();
if(!isset($_SESSION['userid'])) { // falls userid in $_session nicht gesetzt wurde wird die session terminiert und der user aufgefordert sich erst anzumenlden.
    die('Bitte zuerst <a href="login.php">einloggen</a>');
}
//Abfrage der Nutzer ID vom Login
$userid = $_SESSION['userid'];
?>

<?php 
$pdo = new PDO('mysql:host=localhost;dbname=gfn_uebung', 'root', ''); // Erstelle API (PDO) zur Database gfn_uebung
 
if(isset($_GET['delete'])) { // delete wird mit dem wert 1 generiert wenn der user auf den button klickt, dies ist das zeichen das script zu starten
    $password = $_POST['password']; // holt den wert der im formular unter password abgespeichert ist
    
    $statement = $pdo->prepare("SELECT * FROM users WHERE id = :userid"); // bereite ein sql statement vor
    $result = $statement->execute(array('userid' => $userid)); // fuehre statement aus, prueft ob userid in database vorhanden
    $user = $statement->fetch(); // speichere den user (falls vorhanden) in $user
        
    //Überprüfung des Passworts
    if ($user !== false && password_verify($password, $user['password'])) { //falls user vorhanden, fuehre password_verify aus, if password_verify = true 
        
        $statement = $pdo->prepare("DELETE FROM users WHERE id = :userid"); // bereite ein sql statement vor
        $result2 = $statement -> execute(array('userid' => $userid)); // speichert true falls sql befehl erfolgreich war anfernfalls speichert false
        
        if($result2 == true) {
            session_destroy(); // zerstoere die session und all ihre daten
            die('Account der ID ' . $userid . ' erfolgreich geloescht!'); // die = exit function / end script
        }        
     
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

<div class="parent">
		<div class="div1" id="header"><h1 id="headerText">Account loeschen.</h1></div>
		<div class="div2" id="registerField"><form action="?delete=1" method="post">
Dein Passwort:<br>
<input type="password" size="40"  maxlength="250" name="password"><br>
 
<input type="submit" value="Account loeschen!">
		</form> </div>
		<div class="div3" id="loginField"><h4 id="linktext"><a href="http://localhost/GFN_Projects/php_Eigenarbeit/protected_page.php">Interner Bereich.</a></h4></div>
		<div class="div5" id="informationField"><h4 id="linktext"><a href="http://localhost/GFN_Projects/php_Eigenarbeit/info.php">Information</a></h4></div>
		<div class="div6" id="clockField">
			<?php
	           echo date("d-m-Y H:i:s") . "<br><br>";
            ?>
    	</div>
	</div>




</body>
</html>