--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\CpfException;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

try {
    v::cpf()->check('this thing');
} catch (CpfException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::cpf())->check('276.865.775-11');
} catch (CpfException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::cpf()->assert('your mother');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::cpf())->assert('61836182848');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}
?>
--EXPECTF--
"this thing" must be a valid CPF number
"276.865.775-11" must not be a valid CPF number
- "your mother" must be a valid CPF number
- "61836182848" must not be a valid CPF number
