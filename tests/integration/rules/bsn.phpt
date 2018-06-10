--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\BsnException;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

try {
    v::bsn()->check('acb');
} catch (BsnException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::bsn())->check('612890053');
} catch (BsnException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::bsn()->assert('abc');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::bsn())->assert('612890053');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}
?>
--EXPECTF--
"acb" must be a BSN
"612890053" must not be a BSN
- "abc" must be a BSN
- "612890053" must not be a BSN
