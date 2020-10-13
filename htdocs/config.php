<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'sql301.epizy.com');
define('DB_USERNAME', 'epiz_26697856');
define('DB_PASSWORD', 'LvB5u5U06L');
define('DB_NAME', 'epiz_26697856_demo');
 
/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>