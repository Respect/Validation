<?php
date_default_timezone_set('America/Sao_Paulo');
set_include_path('../library/'. PATH_SEPARATOR . './library/' . PATH_SEPARATOR . get_include_path());
require_once 'SplClassLoader.php';
$respectLoader = new \SplClassLoader();
$respectLoader->register();