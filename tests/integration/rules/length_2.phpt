--FILE--
<?php

require_once 'vendor/autoload.php';

use Respect\Validation\Exceptions\LengthException;
use Respect\Validation\Validator as v;

try {
    v::length(0, 5)->check('nawarian');
} catch (LengthException $e) {
    echo $e->getMainMessage().PHP_EOL;
}

try {
    v::length(13, null)->check('phpsp.org.br');
} catch (LengthException $e) {
    echo $e->getMainMessage().PHP_EOL;
}

try {
    v::not(v::length(5, 20))->check('phpsp.org.br');
} catch (LengthException $e) {
    echo $e->getMainMessage().PHP_EOL;
}

?>
--EXPECTF--
"nawarian" must have a length lower than 5
"phpsp.org.br" must have a length greater than 13
"phpsp.org.br" must not have a length between 5 and 20