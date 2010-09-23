<?php

set_include_path(get_include_path() . PATH_SEPARATOR . '../library/');
require_once 'SplClassLoader.php';
$respectLoader = new \SplClassLoader();
$respectLoader->register();