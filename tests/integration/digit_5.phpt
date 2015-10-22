--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\AllOfException;

try {
	v::not(v::digit())->assert(1);
} catch(AllOfException $e) {
	echo $e->getFullMessage();
}

--EXPECTF--
- 1 must not contain digits (0-9)
