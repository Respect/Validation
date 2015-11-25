--FILE--
<?php

require_once 'vendor/autoload.php';

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\AllOfException;

try
{
	v::not(v::pesel())->assert('21120209256');
} catch (AllOfException $e) {
	echo $e->getFullMessage();
}

--EXPECTF--
- "21120209256" must not be a valid PESEL