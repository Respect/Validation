--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\AllOfException;
use Respect\Validation\Exceptions\CpfException;
use Respect\Validation\Validator as v;

try {
    v::cpf()->check('this thing');
} catch (CpfException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::cpf())->check('276.865.775-11');
} catch (CpfException $e) {
    echo $e->getMessage().PHP_EOL;
}

try {
    v::cpf()->assert('your mother');
} catch (AllOfException $e) {
    echo $e->getFullMessage().PHP_EOL;
}
?>
--EXPECTF--
"this thing" must be a valid CPF number
"276.865.775-11" must not be a valid CPF number
- "your mother" must be a valid CPF number
