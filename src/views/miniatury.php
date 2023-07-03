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
				Galeria Udostępnianych zdjęć
			</div>
			<div id="content">
				<?php
					if(isset($_GET['page']))
						$pages = $_GET['page'];
					else
						$pages = 1;
					$pageSize = 3;
					$opts = [
					'skip' => ($pages-1) * $pageSize,
					'limit' => $pageSize
					];
					
					$files = $db->files->find([], $opts);
					$files_num = $db->files->find();
						echo ("<form action=likes/add method=post>");
						foreach ($files as $file) {
							if($file['priv']=='Nie'){
							echo ("<div style=display:inline-block;width:200px;height:220px;;>"."<br/>");
							echo ("<a href="."images/water_".$file['first_name'].">"."<img src="."images/small_".$file['first_name'].">"."</a>");
							echo ("Tytuł:".$file['tytul']."<br/>"."Autor:".$file['author']);
							echo ("<br><label>
									<input type=checkbox value=".$file['_id']." checked> Fajna
									</label>");
							echo ("</div>");
						}
						}
						echo ("<br><button type=submit>zatwierdź</button>");
						echo ("</form>");
						$number=0;
						foreach ($files_num as $file) {
							$number=$number+1;
						}
						$number=$number/$pageSize;
						echo("<div class=pagination>");
						for($i=1;$i<$number+1;$i++){
							echo("<a href=?page=".$i.">".$i."</a>");
						}
						echo("</div>");
						?>
			</div>
		</section>
		<?php include "includes/footer.php"; ?>
	</div>
</body>
</html >