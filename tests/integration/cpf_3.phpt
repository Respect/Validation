--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\AllOfException;

try {
    v::cpf()->assert('your mother');
} catch (AllOfException $e) {
    echo $e->getFullMessage();
}
?>
--EXPECTF--
\-"your mother" must be a valid CPF number
