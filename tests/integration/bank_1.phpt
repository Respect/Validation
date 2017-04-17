--FILE--
<?php

require_once 'vendor/autoload.php';

use Respect\Validation\Validator as v;

v::bank('de')->check('70169464');
v::bank('de')->assert('70169464');

--EXPECTF--;