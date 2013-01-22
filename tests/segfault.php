<?php
include 'bootstrap.php';
use Respect\Validation\ExceptionIterator as EIt;

$arr = array(0, 1, 2, 3, 4, 5 => array(10, 20, 30), 6, 7, 8, 9 => array(1, 2, 3));
foreach(new RecursiveTreeIterator(new Eit($arr, true)) as $i) {
echo "$i\n";
}
