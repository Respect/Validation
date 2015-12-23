--FILE--
<?php

require_once 'vendor/autoload.php';

use Respect\Validation\Validator as v;

v::identityCard()->check('AYE205410');
v::identityCard()->assert('AYE205410');

--EXPECTF--;