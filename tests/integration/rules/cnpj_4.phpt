--FILE--
<?php

require_once 'vendor/autoload.php';

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\CnpjException;

try
{
	v::not(v::cnpj())->check('65.150.175/0001-20');
} catch (CnpjException $e) {
	echo $e->getMainMessage();
}

--EXPECTF--
"65.150.175/0001-20" must not be a valid CNPJ number