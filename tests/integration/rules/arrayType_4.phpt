--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\ArrayTypeException;
use Respect\Validation\Validator as v;

try {
    v::not(v::arrayType())->check([]);
} catch (ArrayTypeException $exception) {
    echo $exception->getMainMessage();
}
?>
--EXPECTF--
{ } must not be of the type array
