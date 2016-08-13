--FILE--
<?php

require_once 'vendor/autoload.php';

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\AllOfException;

try {
	v::vatin('PL')->assert('1645865778');
} catch (AllOfException $e) {
	echo $e->getFullMessage();
}
--EXPECTF--
- "1645865778" must be a valid Polish VAT identification number
