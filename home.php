<!DOCTYPE HTML>
<html>

<head>
	<meta charset="ISO-8859-1">
	 <link rel="stylesheet" href="resources/default.css">
	<title>Index</title>
</head>

<body>
	
	<div class="parent">
		<div class="div1" id="header"><h1 id="headerText">Welcome.</h1></div>
		<div class="div2" id="internField"><h3 id="interntext"><a href="http://localhost/GFN_Projects/php_Eigenarbeit/protected_page.php">Interner Bereich</a></h3></div>
		<div class="div3" id="registerField"><h4 id="linktext"><a href="http://localhost/GFN_Projects/php_Eigenarbeit/register.php">Register</a></h4></div>
		<div class="div4" id="loginField"><h4 id="linktext"><a href="http://localhost/GFN_Projects/php_Eigenarbeit/login.php">Login</a></h4></div>
		<div class="div5" id="informationField"><h4 id="linktext"><a href="http://localhost/GFN_Projects/php_Eigenarbeit/info.php">Information</a></h4></div>
		<div class="div6" id="clockField">
			<?php
	           echo date("d-m-Y H:i:s") . "<br><br>";
            ?>
    	</div>
	</div>
	
</body>
</html>