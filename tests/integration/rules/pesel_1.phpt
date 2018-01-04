--FILE--
<?php

require_once 'vendor/autoload.php';

use Respect\Validation\Validator as v;

v::pesel()->assert('21120209256');
v::pesel()->assertAll('21120209256');
?>
--EXPECTF--;
