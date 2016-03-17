--FILE--
<?php

require_once 'vendor/autoload.php';

use Respect\Validation\Validator as v;

v::pesel()->check('21120209256');
v::pesel()->assert('21120209256');

--EXPECTF--;