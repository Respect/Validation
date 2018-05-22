--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\IntTypeException;
use Respect\Validation\Validator as v;

try {
    v::not(v::allOf(v::intType(), v::positive()))->check(42);
} catch (IntTypeException $e) {
    echo $e->getMessage();
}
?>
--EXPECTF--
42 must not be of type integer
