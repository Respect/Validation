--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\AllOfException;
use Respect\Validation\Exceptions\NumericValException;
use Respect\Validation\Validator as v;

try {
    v::numericVal()->check('a');
} catch (NumericValException $e) {
    echo $e->getMessage().PHP_EOL;
}

try {
    v::numericVal()->assert('a');
} catch (AllOfException $e) {
    echo $e->getFullMessage().PHP_EOL;
}
?>
--EXPECTF--
"a" must be numeric
- "a" must be numeric
