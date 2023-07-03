<?php

require_once '../business.php';

$db = get_db();

?>
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
				Galeria Prywatna
			</div>
			<?php
					
					$files = $db->files->find();
					$files_num = $db->files->find();
						foreach ($files as $file) {
							if($file['author']==$account['login']){
							echo "<div style=display:inline-block;width:200px;height:140px;;>"."<br/>"."<a href="."images/water_".$file['first_name'].">"."<img src="."images/small_".$file['first_name'].">"."</a>"."Tytuł:".$file['tytul']."<br/>"."Autor:".$file['author']."<br> Prywatne: ".$file['priv']."</div>";
						}
						}
						?>
		</section>
		<?php include "includes/footer.php"; ?>
	</div>
</body>
</html >