<?php


use MongoDB\BSON\ObjectID;


function get_db()
{
    $mongo = new MongoDB\Client(
        "mongodb://localhost:27017/wai",
        [
            'username' => 'wai_web',
            'password' => 'w@i_w3b',
        ]);

    $db = $mongo->wai;

    return $db;
}
function clearDbState() {
    $db = get_db();

    $db->users->deleteMany(['name' => ['$regex' => '']]);
}
function getAccount($login) {
     $db = get_db();
    return $db->users->findOne(['login' => $login]);
}

function verifyRegistrationForm($postArr) {
    if($postArr['login'] === '' ) {
        return 1;
    }

    if($postArr['mail'] === '') {
        return 2;
    }

    if($postArr['password'] === '') {
        return 3;
    } 
	if($postArr['password_1'] === '') {
        return 4;
    } 
	if($postArr['password_1'] !==$postArr['password'] ) {
        return 5;
    } 
	
		$password=$postArr['password'];
		$password_hashed=password_hash($password, PASSWORD_DEFAULT);

    $account = [
        'login' => $postArr['login'],
        'mail' => $postArr['mail'],
        'password' => $password_hashed
    ];
    
     $db = get_db();

     $current = getAccount($postArr['login']);
     
     if($current === NULL){ 
         $db->users->insertOne($account);
         return 0;
     } else{
        return 6;
     }

}

function verifyLoginForm($postArr) {
    $login = $postArr['login'];
    $password = $postArr['password'];


    $db = get_db();
	$users = $db->users->find();

	foreach ($users as $account) {
		if($login===$account['login'] && password_verify($password, $account['password'])){
			$_SESSION["logged_in"] = 1;
			$_SESSION["account_id"] = $login;
			return true;
		}
	}		
	return false;

}