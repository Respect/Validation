--FILE--
<?php

require_once 'vendor/autoload.php';

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\AllOfException;

try
{
	v::cnpj()->digit()->assert('65.150.175/0001-20');
} catch (AllOfException $e) {
	echo $e->getFullMessage();
}

--EXPECTF--
- "65.150.175/0001-20" must contain only digits (0-9)