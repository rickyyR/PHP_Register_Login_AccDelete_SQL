<?php 
//  Session variables hold information about one single user, and are available to all pages in one application
session_start(); // start session to hold variables.
$pdo = new PDO('mysql:host=localhost;dbname=gfn_uebung', 'root', ''); // PDO = API to database. Create new PDO to gfn_uebungen database
?>
<!DOCTYPE html> 
<html> 
<head>
	<link rel="stylesheet" href="resources/default.css">
  	<title>Register</title>    
</head> 
<body>
 
<?php
$showFormular = true; //Variable ob das Registrierungsformular anezeigt werden soll
 
if(isset($_GET['register'])) { // $_GET register wird gesetzt (isset = true) wenn der user auf den button klickt
    $error = false;
    $email = $_POST['email']; // hole den wert von email aus dem formular
    $password = $_POST['password']; // hole den wert von password aus dem formular
    $password2 = $_POST['password2']; // hole den wert von password2 aus dem formular
  
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) { // filter eine variable, in diesem fall $email mit dem filter validat_email, gibt false falls eingabe laut filter keine gueltige email ist
        echo 'Bitte eine gültige E-Mail-Adresse eingeben<br>';
        $error = true; // error wird true da ein fehler aufgetreten ist (keine gueltige mailadresse)
    }     
    if(strlen($password) == 0) { // wenn passwort laenge = 0
        echo 'Bitte ein Passwort angeben<br>';
        $error = true; // error wird true da ein fehler aufgetreten ist (passwort laenge = 0)
    }
    if($password != $password2) { // wenn password und passwor2 nicht uebereinstimmen
        echo 'Die Passwörter müssen übereinstimmen<br>';
        $error = true; // error wird true da ein fehler aufgetreten ist (falsches zeites passwort)
    }
    
    //Überprüfe, dass die E-Mail-Adresse noch nicht registriert wurde
    if(!$error) { 
        $statement = $pdo->prepare("SELECT * FROM users WHERE email = :email"); // speichere einen ueber die api(pdo) ausfuehrbaren sql befehl in der variable $statement 
        $result = $statement->execute(array('email' => $email)); // fuehrt $statement aus und speicher eventuelle ergebnisse in einem array.
        $user = $statement->fetch(); // holt das naechste ergebnis aus dem array und speicher es in $user
        
        if($user !== false) { // if user !== false = user schon vorhanden / email schon registriert
            echo 'Diese E-Mail-Adresse ist bereits vergeben<br>';
            $error = true; // error wird true da ein fehler aufgetreten ist (email vergeben)
        }    
    }
    
    //Keine Fehler, wir können den Nutzer registrieren
    if(!$error) {    
        $password_hash = password_hash($password, PASSWORD_DEFAULT); // erstelle einen password hash aus dem angegebene passwort
        
        $statement = $pdo->prepare("INSERT INTO users (email, password) VALUES (:email, :password)"); // bereite sql befehl vor
        $result = $statement->execute(array('email' => $email, 'password' => $password_hash)); // speichere email und pw hash in sql tabelle, gibt bool true oder false (bei fehler) und speichert es in $result
        
        // pruefe ueber $result ob beim speichern der daten ein fehler aufgetreten ist.
        if($result) {        
            echo 'Du wurdest erfolgreich registriert. <a href="login.php">Zum Login</a>';
            $showFormular = false; // setzt show formula auf false da der benutzer sich registriert hat und das registrierungsformular nicht mehr benoetigt.
        } else {
            echo 'Beim Abspeichern ist leider ein Fehler aufgetreten<br>';
        }
    } 
}
 

// Das eigentliche Formular/Frontend, die Fleachen die der User sieht und verwendet
if($showFormular) {
?>
 
<form action="?register=1" method="post">
E-Mail:<br>
<input type="email" size="40" maxlength="250" name="email"><br><br>
 
Dein Passwort:<br>
<input type="password" size="40"  maxlength="250" name="password"><br>
 
Passwort wiederholen:<br>
<input type="password" size="40" maxlength="250" name="password2"><br><br>
 
<input type="submit" value="Abschicken">
</form>
 
<?php
} //Ende von if($showFormular)
?>
 
<br>
<a href="http://localhost/GFN_Projects/php_Eigenarbeit/home.php">Home</a>
 
</body>
</html>