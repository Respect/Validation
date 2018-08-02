--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\ImeiException;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

try {
    v::imei()->check('490154203237512');
} catch (ImeiException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::imei())->check('350077523237513');
} catch (ImeiException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::imei()->assert(null);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::imei())->assert('356938035643809');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

?>
--EXPECTF--
"490154203237512" must be a valid IMEI
"350077523237513" must not be a valid IMEI
- `NULL` must be a valid IMEI
- "356938035643809" must not be a valid IMEI
