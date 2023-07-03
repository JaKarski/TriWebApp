<?php
require_once 'business.php';


function index(&$model)
{
    return 'index';
}
function galeria(&$model)
{
    return 'galeria';
}
function registration(&$model)
{
    return 'registration';
}
function login(&$model)
{
    return 'partial/login';
}

function logowanie(&$model) {
    
    if(isset($_GET['logout'])) {
        $model['logout'] = $_GET['logout'];
    }

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == 1) {
             $model['account'] = getAccount($_SESSION['account_id']);
            return 'index';
        } else {
            return 'index';
        }
    } else {
        if(isset($_POST['register'])) {
            $regResult = verifyRegistrationForm($_POST);
            $model['regResult'] = $regResult;
            return 'registration';
        } else {
            if(verifyLoginForm($_POST)) {
                $model['account'] = getAccount($_SESSION['account_id']);
                return 'index';
            } else {
                return 'redirect:index?login=failed';
            }

        }
    }

}

function logout(&$model) {
    if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == 1) {
        session_destroy();
        return 'redirect:index?logout=passed';
    } 
    return 'redirect:index?logout=failed';
}

function logged(&$model)
{
	$model['account'] = getAccount($_SESSION['account_id']);
    return 'partial/logged';
}
function priv(&$model)
{
	$model['account'] = getAccount($_SESSION['account_id']);
    return 'private_gallery';
}
function author(&$model)
{
	$model['account'] = getAccount($_SESSION['account_id']);
    return 'partial/author';
}

function miniatury(&$model)
{
    return 'miniatury';
}
function galeria_up(&$model)
{
	$db = get_db();

$allowedImgTypes= array("jpg","png");
$name = basename($_FILES["fileToUploadName"]["name"]);

$target_dir = "/var/www/prod/src/web/images/";
$target_file = $target_dir . basename($_FILES["fileToUploadName"]["name"]);
$model['errors'] = 0;
$fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

if (filesize($_FILES['fileToUploadName']['tmp_name']) > 1048576 || $_FILES["fileToUploadName"]["error"] == 1) {
   $model['errors'] = 1;
  	return "galeria";
}

if(isset($_POST["submit"])) {
  if(!in_array($fileType, $allowedImgTypes)) {
    $model['errors'] = 2;
		return "galeria";
  }
}

if (file_exists($target_file)) {
    $model['errors'] = 3;
		return "galeria";
}

 if($_POST['watermark']==NULL) {
    $model['errors'] = 6;
		return "galeria";
    } 
 if($_POST['autor']==NULL) {
    $model['errors'] = 7;
		return "galeria";
    }
 if($_POST['tytul']==NULL) {
    $model['errors'] = 8;
		return "galeria";
    }
	
if ($model['errors'] == 0) {
  if (!move_uploaded_file($_FILES["fileToUploadName"]["tmp_name"], $target_file)) {
   $model['errors'] = 5;
  } else {

    //end of storing part - begin DB part
    $friendlyName=basename($_FILES["fileToUploadName"]["name"]);

   
	
	$original = $target_dir.$name;
	$watermark = $_POST["watermark"];
	$small = imagecreatetruecolor(200, 120);
	$source = imagecreatefromjpeg($original);
	$water = imagecreatefromjpeg($original);
	$original_dimensions = getimagesize($original);
	$width = $original_dimensions[0];
	$height = $original_dimensions[1];
	
	
	imagecopyresized($small, $source, 0, 0, 0, 0, 200, 125, $width, $height);
	
	$bialy = ImageColorAllocate($water, 255, 255, 255);
	$nieb = ImageColorAllocate($water, 0, 255, 255);
	
	ImageString($water, 15, 50, 10, $watermark, $bialy);
	ImageString($water, 5, 180, 20, $watermark, $nieb);
	
	imagejpeg($small, $target_dir.'small_'.$name);
	imagejpeg($water, $target_dir.'water_'.$name);

	
    $fileDbObject = [
      'first_name' => $name,
      'author' => $_POST['autor'],
      'tytul' => $_POST['tytul'],
      'priv' => $_POST['priv']
    ];

    $db->files->insertOne($fileDbObject);
	return "galeria";
  }
  	
}

}