<?PHP
/* Connexion au serveur et à la base de données */
$host="sqletud.u-pem.fr";
$user="ygerma02"; /* Votre login */
$pwd="z2eaSiyut5"; /* Votre mot de passe*/
$db="ygerma02_db"; /* 
Le nom de votre base : de la forme ici : xxx_db avec xxx votre 
login */
// Connexion avec avec PDO
try{
$con='mysql:host='.$host.';dbname='.$db;
$dbh = new PDO($con,$user,$pwd,array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,PDO::MYSQL_ATTR_INIT_COMMAND => ' SET NAMES utf8'));
}
catch(Exception $e){
die('Connexion impossible à la base de données !'.$e->getMessage());
}
?>
