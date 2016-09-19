--FILE--
<?php

require_once 'vendor/autoload.php';

use Respect\Validation\Validator as v;

v::vatin('PL')->check('1645865777');
v::vatin('PL')->assert('1645865777');
?>
--EXPECTF--
