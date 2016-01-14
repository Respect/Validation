--FILE--
<?php

require_once 'vendor/autoload.php';

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\AllOfException;

try {
	v::identityCard('PL')->assert('AYE205411');
} catch (AllOfException $e) {
	echo $e->getFullMessage();
}
--EXPECTF--
- "AYE205411" must be a valid Polish Identity Card number
