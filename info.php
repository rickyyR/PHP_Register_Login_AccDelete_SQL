<!DOCTYPE HTML>
<html>

<head>
	<meta charset="ISO-8859-1">
	<link rel="stylesheet" href="resources/default.css">
	<title>Home</title>
</head>

<body>
	
	<div class="parent">
		<div class="div1" id="header"><h1 id="headerText">Information.</h1></div>
		<div class="div5" id="informationField"><h4 id="linktext"><a href="http://localhost/GFN_Projects/php_Eigenarbeit/protected_page.php">Interner Bereich</a></h4></div>
		<div class="div3" id="registerField"><h4 id="linktext"><a href="http://localhost/GFN_Projects/php_Eigenarbeit/home.php">Home</a></h4></div>
		<div class="div2" id="internField"><p>Projekt Eigenarbeit by P.R</p></div>
		<div class="div6" id="clockField">
			<?php
	           echo date("d-m-Y H:i:s") . "<br><br>";
            ?>
    	</div>
	</div>
	
</body>

</html>   