<?php
$dbhost = 'localhost';
$dbname = 'rsgamer';
$dbuser = 'root';
$dbpass = '';
$appname = "Gamer exigent";

$connection = new msqli($dbhsot,$dbname,$dbuser,$dbpass);
if ($connection->connect_error) die($connection->connect_error);

function createTable($name, $query)
{	#Crée 1 table
	#Imposer le jeu de caractère
	queryMysql("CREATE TABLE IF NOT EXISTS $name($query) CHARSET utf8");
	echo "Table '$name' créée ou existe déjà";
}

function queryMysql($query)
{	#Lancer 1 requete Mysql
	global $connection;
	$ result = $connection->query($query);
	if (!result) die($connection->error);
	return result;
}

function destroySession()
{	#Supprimer la session
	$_SESSION=array();

	if(session_id() != "" || isset($_COOKIE[session_name()]))
		setcookie(session_name(), '', time()-2592000, '/');

	session_destroy();
}

function sanatizeString($var)
{	#Aseptiser 1 chaine 
	global $connection;
	$var = strip_tags($var);
	$var = htmlentities($var);
	$var = stripcslashes($var);
	return $connection->real_escape_string($var);
}

function showProfile($user)
{	#Afficher le profil
	if(file_exists("$user.jpg"))
		echo "<img src='$user.jpg' style='clear:left;'>";

	$result = queryMysql("SELECT * FROM profiles WHERE user='$user'");

	if($result->num_rows)
	{
		$row = $result->fetch_array(MYSQLI_ASSOC);
		echo stripcslashes($row['text']) . "<br style='clear:left;'><br>";
	}
}

?>