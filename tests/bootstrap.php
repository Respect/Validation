<?php
date_default_timezone_set('America/Sao_Paulo');
set_include_path(get_include_path() . PATH_SEPARATOR . '../library/'. PATH_SEPARATOR . './library/');
require_once 'SplClassLoader.php';
$respectLoader = new \SplClassLoader();
$respectLoader->register();