--FILE--
<?php

require_once 'vendor/autoload.php';

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\IdentityCardException;

try
{
	v::not(v::identityCard())->check('AYE205410');
} catch (IdentityCardException $e) {
	echo $e->getMainMessage();
}

--EXPECTF--
"AYE205410" must not be a valid Identity Card number