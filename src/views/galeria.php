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
				Udostępnij zdjęcie
			</div>
			
		<form action="galeria_up" method="post" enctype="multipart/form-data">
			 Miejsce na wstawienie zdjęcia:
			<input type="file" name="fileToUploadName"> <br>
			Znak Wodny:
			<input type="text" name="watermark"> <br>
			Podaj tytul:
			<input type="text" name="tytul"> <br>
			Podaj autora:
			
			<?php 
						if(isset($_SESSION['logged_in']))
						{
							dispatch($routing, '/author');
						}
						else
						{
							echo("<input type=text name=autor> <br>");
							echo(	"Wybierz prywatność:
							<label>
								<input type=radio name=priv value=Tak disabled> Prywatne
							</label>

							<label>
								<input type=radio name=priv value=Nie checked> Publiczne
							</label>
							<br>");
						}
					?>
			
			<input type="submit" value="Upload File" name="submit">
		</form>

<?php
    if(isset($errors)){
        switch ($errors) {
            case 0:
                echo " <p style=color:green;>Wysyłanie pliku udane!</p>";
            break;
            case 1:
                 echo " <p style=color:red;>Błąd przesłania pliku: Plik jest zbyt duży!</p>";
            break;
            case 2:
                 echo " <p style=color:red;>Błąd przesłania pliku: Nie dozwolone rozszerzenie!</p>";
            break;
            case 3:
                 echo " <p style=color:red;>Błąd przesłania pliku: Plik już istnieje!</p>";
            break;
            case 4:
                 echo " <p style=color:red;>Błąd przesłania pliku: Problem z wysłaniem pliku ze strony klienta!</p>";
            break;
             case 5:
                 echo " <p style=color:red;>Błąd przesłania pliku: Problem z wysłaniem pliku ze strony serwera</p>";
            break;
			case 6:
                 echo " <p style=color:red;>Pole WaterMark puste!</p>";
            break;
			case 7:
                 echo " <p style=color:red;>Pole Autor puste!</p>";
            break;
			case 8:
                 echo " <p style=color:red;>Pole Tytuł puste!</p>";
            break;
    }
}    
?>

		</section>
		<?php include "includes/footer.php"; ?>
	</div>
</body>
</html >