--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\AllOfException;
use Respect\Validation\Exceptions\NumericValException;
use Respect\Validation\Validator as v;

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
?>
--EXPECTF--
Field must be numeric
- Field must be numeric
