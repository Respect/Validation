--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\AllOfException;
use Respect\Validation\Exceptions\NumericValException;
use Respect\Validation\Validator as v;

try {
    v::not(v::numericVal())->check('1');
} catch (NumericValException $e) {
    echo $e->getMessage().PHP_EOL;
}

try {
    v::not(v::numericVal())->assert('1');
} catch (AllOfException $e) {
    echo $e->getFullMessage().PHP_EOL;
}
?>
--EXPECTF--
"1" must not be numeric
- "1" must not be numeric