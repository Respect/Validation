--FILE--
<?php

require_once 'vendor/autoload.php';

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\IdentityCardException;

try
{
	v::identityCard()->check('AYE205411');
} catch (IdentityCardException $e) {
	echo $e->getMainMessage();
}

--EXPECTF--;
"AYE205411" must be a valid Identity Card number