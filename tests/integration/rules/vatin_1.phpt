--FILE--
<?php

require_once 'vendor/autoload.php';

use Respect\Validation\Validator as v;

v::vatin('PL')->assert('1645865777');
v::vatin('PL')->assertAll('1645865777');
?>
--EXPECTF--
