<?php

require('compile.php');

$language = $_POST['lang'];

$code = $_POST['code'];

$input = $_POST['input'];

$out = compile($language,$code,'');

echo $out;

?>
