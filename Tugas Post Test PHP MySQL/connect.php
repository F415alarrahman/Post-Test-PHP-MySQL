<?php

define('HOST', 'localhost');
define('USER', 'root');
define('PASS', '');
define('DB', 'users');

$con = mysqli_connect(HOST, USER, PASS, DB) or die('unable to connect');



date_default_timezone_set('Asia/Jakarta');
$tglSekarang = date('Y-m-d H:i:s');
echo "Connected successfully at " . $tglSekarang;
