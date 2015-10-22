--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\DigitException;

try {
	v::digit()->check('a');
} catch(DigitException $e) {
	echo $e->getMainMessage();
}

--EXPECTF--
"a" must contain only digits (0-9)
