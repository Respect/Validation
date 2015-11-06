--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\ArrayTypeException;
use Respect\Validation\Validator as v;

try {
    v::arrayType()->check('teste');
} catch (ArrayTypeException $exception) {
    echo $exception->getMainMessage();
}
?>
--EXPECTF--
"teste" must be of the type array
