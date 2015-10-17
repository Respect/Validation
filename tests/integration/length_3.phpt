--FILE--
<?php

require_once 'vendor/autoload.php';

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\AllOfException;

try {
    v::length(3, 5)->assert('phpsp.org.br');
} catch (AllOfException $e) {
    echo $e->getFullMessage();
}
?>
--EXPECTF--
\-"phpsp.org.br" must have a length between 3 and 5