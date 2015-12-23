--FILE--
<?php

require_once 'vendor/autoload.php';

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\AllOfException;

try
{
	v::not(v::identityCard())->assert('AYE205410');
} catch (AllOfException $e) {
	echo $e->getFullMessage();
}

--EXPECTF--
- "AYE205410" must not be a valid Identity Card number