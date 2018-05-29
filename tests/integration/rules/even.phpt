--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\EvenException;
use Respect\Validation\Validator as v;

try {
    v::even()->check(-1);
} catch (EvenException $e) {
    echo $e->getMessage().PHP_EOL;
}

try {
    v::even()->check(5);
} catch (EvenException $e) {
    echo $e->getMessage().PHP_EOL;
}

try {
    v::not(v::even())->check(6);
} catch (EvenException $e) {
    echo $e->getMessage().PHP_EOL;
}
?>
--EXPECTF--
-1 must be an even number
5 must be an even number
6 must not be an even number
