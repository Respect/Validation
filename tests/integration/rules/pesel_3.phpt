--FILE--
<?php

require_once 'vendor/autoload.php';

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\AllOfException;

try
{
	v::pesel()->assert('21120209251');
} catch (AllOfException $e) {
	echo $e->getFullMessage();
}
--EXPECTF--
- "21120209251" must be a valid PESEL