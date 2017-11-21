--FILE--
<?php

require_once 'vendor/autoload.php';

use Respect\Validation\Validator as v;

v::identityCard('PL')->assert('AYE205410');
v::identityCard('PL')->assertAll('AYE205410');
?>
--EXPECTF--
