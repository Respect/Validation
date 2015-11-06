--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\AllOfException;
use Respect\Validation\Exceptions\ImeiException;
use Respect\Validation\Validator as v;

try {
    v::not(v::imei())->check('35-007752-323751-3');
} catch (ImeiException $e) {
    echo $e->getMainMessage().PHP_EOL;
}

try {
    v::not(v::imei())->assert('350077523237513');
} catch (AllOfException $e) {
    echo $e->getFullMessage().PHP_EOL;
}
?>
--EXPECTF--
"35-007752-323751-3" must not be a valid IMEI
- "350077523237513" must not be a valid IMEI
