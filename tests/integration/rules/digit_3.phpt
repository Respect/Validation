--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\AllOfException;

try {
	v::digit()->assert('a');
} catch(AllOfException $e) {
	echo $e->getFullMessage();
}

--EXPECTF--
- "a" must contain only digits (0-9)
