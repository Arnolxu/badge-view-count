<?php

if(!isset($_GET['username'])) {
	echo "username is not set";
	exit();
}

$counter_name = "../counter/" . $_GET["username"] . ".txt";

// Check if a text file exists.
// If not create one and initialize it to zero.
if (!file_exists($counter_name)) {
  $f = fopen($counter_name, "w");
  fwrite($f,"0");
  fclose($f);
}

// Read the current value of our counter file
$f = fopen($counter_name,"r");
$counterVal = fread($f, filesize($counter_name));
fclose($f);

$counterVal = intval($counterVal);

$counterVal++;
$f = fopen($counter_name, "w");
fwrite($f, $counterVal);
fclose($f);

$file = 'gh.php';
$last_modified_time = filemtime($file);
header("Last-Modified: ".gmdate("D, d M Y H:i:s", $last_modified_time)." GMT");
header("Content-Type: image/svg+xml");
header('Cache-Control: no-cache');
header('Expires: '.gmdate('D, d M Y H:i:s \G\M\T', time()));

echo file_get_contents('https://img.shields.io/badge/'.$counterVal.'%20Views-121011?style=for-the-badge&logo=github');
