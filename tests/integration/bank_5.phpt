--FILE--
<?php

require_once 'vendor/autoload.php';

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\AllOfException;

try
{
	v::not(v::bank('de'))->assert('70169464');
} catch (AllOfException $e) {
	echo $e->getFullMessage();
}

--EXPECTF--
\-"70169464" must not be a bank