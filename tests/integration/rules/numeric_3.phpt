--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\AllOfException;
use Respect\Validation\Exceptions\NumericValException;
use Respect\Validation\Validator as v;

try {
    v::numericVal()->setName('Field')->assert(null);
} catch (NumericValException $e) {
    echo $e->getMainMessage().PHP_EOL;
}

try {
    v::numericVal()->setName('Field')->assertAll('');
} catch (AllOfException $e) {
    echo $e->getFullMessage().PHP_EOL;
}
?>
--EXPECTF--
Field must be numeric
- Field must be numeric
