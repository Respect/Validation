--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\CnhException;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

try {
    v::cnh()->check('batman');
} catch (CnhException $e) {
    echo $e->getMessage().PHP_EOL;
}

try {
    v::not(v::cnh())->check('02650306461');
} catch (CnhException $e) {
    echo $e->getMessage().PHP_EOL;
}

try {
    v::cnh()->assert('bruce wayne');
} catch (NestedValidationException $e) {
    echo $e->getFullMessage().PHP_EOL;
}

try {
    v::not(v::cnh())->assert('02650306461');
} catch (NestedValidationException $e) {
    echo $e->getFullMessage().PHP_EOL;
}
?>
--EXPECTF--
"batman" must be a valid CNH number
"02650306461" must not be a valid CNH number
- "bruce wayne" must be a valid CNH number
- "02650306461" must not be a valid CNH number
