<?php
session_start();
if(!isset($_SESSION['userid'])) { // falls userid in $_session nicht gesetzt wurde wird die session terminiert und der user aufgefordert sich erst anzumenlden.
    die('Bitte zuerst <a href="login.php">einloggen</a>');
}

//Abfrage der Nutzer ID vom Login
$userid = $_SESSION['userid'];
?>

<!DOCTYPE HTML>
<html>

<head>
	<meta charset="ISO-8859-1">
	<link rel="stylesheet" href="resources/default.css">
	<title>Interner Bereich</title>
</head>

<body>

	
	<div class="parent">
		<div class="div1" id="header"><h1 id="headerText">Interner Bereich.</h1></div>
		<div class="div3" id="registerField"><h4 id="linktext"><a href="http://localhost/GFN_Projects/php_Eigenarbeit//delete_account.php">Account loeschen</a></h4></div>
		<div class="div4" id="loginField"><h4 id="linktext"><a href="http://localhost/GFN_Projects/php_Eigenarbeit/logout.php">Logout</a></h4></div>
		<div class="div5" id="informationField"><h4 id="linktext"><a href="http://localhost/GFN_Projects/php_Eigenarbeit/info.php">Information</a></h4></div>
		<div class="div6" id="clockField">
			<?php
	           echo date("d-m-Y H:i:s") . "<br><br>";
            ?>
    	</div>
	</div>
	
</body>

</html>   