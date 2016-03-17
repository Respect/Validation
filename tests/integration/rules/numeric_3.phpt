--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\AllOfException;
use Respect\Validation\Exceptions\NumericException;
use Respect\Validation\Validator as v;

try {
    v::numeric()->setName('Field')->check(null);
} catch (NumericException $e) {
    echo $e->getMainMessage().PHP_EOL;
}

try {
    v::numeric()->setName('Field')->assert('');
} catch (AllOfException $e) {
    echo $e->getFullMessage().PHP_EOL;
}
?>
--EXPECTF--
Field must be numeric
- Field must be numeric
