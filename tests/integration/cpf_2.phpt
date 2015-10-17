--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\CpfException;

try {
    v::cpf()->check('this thing');
} catch (CpfException $e) {
    echo $e->getMainMessage();
}

?>
--EXPECTF--
"this thing" must be a valid CPF number
