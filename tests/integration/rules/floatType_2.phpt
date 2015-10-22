--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\FloatTypeException;
use Respect\Validation\Validator as v;

try {
    v::floatType()->check('42.33');
} catch (FloatTypeException $exception) {
    echo $exception->getMainMessage();
}
?>
--EXPECTF--
"42.33" must be of the type float
