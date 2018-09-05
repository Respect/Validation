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

try {
    v::numericVal()->setName('Field')->check(null);
} catch (NumericValException $e) {
    echo $e->getMessage().PHP_EOL;
}

try {
    v::numericVal()->setName('Field')->assert('');
} catch (AllOfException $e) {
    echo $e->getFullMessage().PHP_EOL;
}

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
"a" must be numeric
- "a" must be numeric
Field must be numeric
- Field must be numeric
"1" must not be numeric
- "1" must not be numeric