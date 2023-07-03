<?php 
	
      if(isset($_GET['dbclear'])) {
            echo "<h1 style=color:red;>Baza DB pusta!</h1>";
        }

    if(isset($_GET['logout'])) {
        if($_GET['logout'] == 'passed') {
          echo "<h2 style=color:green;>Poprawne wylogowywanie!</h2>";
        } else {
            echo "<h2 style=color:red;>Błąd wylogowania!</h2>";
        }
    }
    ?>
    <div id="logowanie">
    Zaloguj się:
    <form action="logowanie" method="post" enctype="multipart/form-data">
    Login:
    <input type="text" name="login" id="nameId"> <br>
    Hasło:
    <input type="password" name="password" id="peselId"> <br>

    <input type="submit" value="Login" name="submit">
    <?php 
    if(isset($_GET['login']))		{
		if($_GET['login']=='failed'){
        echo "<p style=color:red;>Błąd logowania!</p>";
		}
    }
    ?>
	<input type="button" value="Nowy użytkownik" onClick="location.href='registration';" />
	</div>