<!DOCTYPE HTML>
<html lang="pl">
<head>
	<?php include "includes/head.php"; ?>
</head>

<body>
	<div id="container">
		<?php include "includes/header.php"; ?>
		<section>
			<div class="menu">
				Nowy użytkownik
			</div>
			<div id="content">
				   Register new user:

    <form action="logowanie" method="post" enctype="multipart/form-data">
    Login:
    <input type="text" name="login" id="loginId"> <br>
    Ares e-mail:
    <input type="text" name="mail" id="mailId"> <br>
    Hasło:
    <input type="password" name="password" id="passwordId"> <br>
	Powtórz hasło:
    <input type="password" name="password_1" id="passwordId"> 
	<br>
    <input type="checkbox" name="register" checked="checked" style="opacity:0; position:absolute; left:9999px;">
    <input type="submit" value="Register" name="submit">
     <?php 
    if(isset($regResult)) {
        switch ($regResult) {
            case 0:
                echo " <p style=color:green;>Rejestracja udana!</p>";
            break;
            case 1:
                 echo " <p style=color:red;>Pole Login puste!!</p>";
            break;
            case 2:
                 echo " <p style=color:red;>Pole Imię puste!</p>";
            break;
            case 3:
                 echo " <p style=color:red;>Pole Hasło puste!</p>";
            break;
			case 4:
                 echo " <p style=color:red;>Pole Powtórz hasło puste!</p>";
            break;
			case 5:
                 echo " <p style=color:red;>Hasła nie są takie same</p>";
            break;
            case 6:
                 echo " <p style=color:red;>Urzytkownik już istneje (login zajęty)</p>";
            break;
    }
}
    ?>
			</div>
		</section>
		<?php include "includes/footer.php"; ?>
	</div>
</body>
</html >