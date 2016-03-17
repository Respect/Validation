--TEST--
PhpLabel rule exception should be thrown by check() method
--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\PhpLabelException;
use Respect\Validation\Validator as v;

try {
    v::phpLabel()->check('f o o');
} catch (PhpLabelException $e) {
    echo $e->getMainMessage().PHP_EOL;
}

try {
    v::not(v::phpLabel())->check('correctOne');
} catch (PhpLabelException $e) {
    echo $e->getMainMessage().PHP_EOL;
}
?>
--EXPECTF--
"f o o" must be a valid PHP label
"correctOne" must not be a valid PHP label
