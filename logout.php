<?php
require 'connect.php';

$_SESSION['token']='';
$_SESSION['cargo']='';
header("Location: ".$base);
exit;