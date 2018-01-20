--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\MinException;
use Respect\Validation\Validator as v;

try {
    v::intType()->between(1, 2)->check(-42);
} catch (MinException $e) {
    echo $e->getMainMessage().PHP_EOL;
}
?>
--EXPECTF--
-42 must be greater than or equal to 1
