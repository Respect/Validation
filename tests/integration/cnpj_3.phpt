--FILE--
<?php

require_once 'vendor/autoload.php';

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\AllOfException;

try
{
	v::cnpj()->assert('test');
} catch (AllOfException $e) {
	echo $e->getFullMessage();
}
--EXPECTF--
- "test" must be a valid CNPJ number