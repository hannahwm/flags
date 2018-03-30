<?php
//GRANT INSERT, SELECT, DELETE, UPDATE ON test_emails.* TO 'root' @ 'localhost' IDENTIFIED BY 'root';

DEFINE ('DB_USER', 'huskynunews');
DEFINE ('DB_PASSWORD', 'lW5cHC1yhFdGn9667WTP');
DEFINE ('DB_HOST', '127.0.0.1');
DEFINE ('DB_NAME', 'wp_huskynunews');

$dsn = 'mysql:host='. DB_HOST . ';dbname=' . DB_NAME;
try {
$pdo = new PDO('mysql:host='. DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

} catch(PDOException $e) {
echo 'ERROR: ' . $e->getMessage();
}
?>
