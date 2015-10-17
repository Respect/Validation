--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\AllOfException;

try {
    v::not(v::cpf())->assert('368.928.062-10');
} catch (AllOfException $e) {
    echo $e->getFullMessage().PHP_EOL;
}
?>
--EXPECTF--
\-"368.928.062-10" must not be a valid CPF number
