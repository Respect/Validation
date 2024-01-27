--CREDITS--
William Espindola <oi@williamespindola.com.br>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::cpf()->check('this thing'));
exceptionMessage(static fn() => v::not(v::cpf())->check('276.865.775-11'));
exceptionFullMessage(static fn() => v::cpf()->assert('your mother'));
exceptionFullMessage(static fn() => v::not(v::cpf())->assert('61836182848'));
?>
--EXPECT--
"this thing" must be a valid CPF number
"276.865.775-11" must not be a valid CPF number
- "your mother" must be a valid CPF number
- "61836182848" must not be a valid CPF number
