--FILE--
<?php

require_once 'vendor/autoload.php';

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\AllOfException;

try
{
	v::not(v::cnpj())->assert('65150175000120');
} catch (AllOfException $e) {
	echo $e->getFullMessage();
}

--EXPECTF--
- "65150175000120" must not be a valid CNPJ number