<?php
$url = $_SERVER['PHP_SELF'];
$short_url = explode('/', $url);
$path = "http://localhost".$short_url[0].'/'.$short_url[1];
?>