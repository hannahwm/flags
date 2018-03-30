<?php
//GRANT INSERT, SELECT, DELETE, UPDATE ON test_emails.* TO 'root' @ 'localhost' IDENTIFIED BY 'root';

DEFINE ('DB_USER', 'root');
DEFINE ('DB_PASSWORD', 'root');
DEFINE ('DB_HOST', 'localhost');
DEFINE ('DB_NAME', 'flags_2018');

$dsn = 'mysql:host='. DB_HOST . ';dbname=' . DB_NAME;
try {
$pdo = new PDO('mysql:host='. DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

} catch(PDOException $e) {
echo 'ERROR: ' . $e->getMessage();
}
?>
