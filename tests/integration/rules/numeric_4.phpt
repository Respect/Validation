--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\AllOfException;
use Respect\Validation\Exceptions\NumericException;
use Respect\Validation\Validator as v;

try {
    v::not(v::numeric())->check('1');
} catch (NumericException $e) {
    echo $e->getMainMessage().PHP_EOL;
}

try {
    v::not(v::numeric())->assert('1');
} catch (AllOfException $e) {
    echo $e->getFullMessage().PHP_EOL;
}
?>
--EXPECTF--
"1" must not be numeric
- "1" must not be numeric