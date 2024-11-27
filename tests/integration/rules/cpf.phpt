--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::cpf()->assert('this thing'));
exceptionMessage(static fn() => v::not(v::cpf())->assert('276.865.775-11'));
exceptionFullMessage(static fn() => v::cpf()->assert('your mother'));
exceptionFullMessage(static fn() => v::not(v::cpf())->assert('61836182848'));
?>
--EXPECT--
"this thing" must be a valid CPF number
"276.865.775-11" must not be a valid CPF number
- "your mother" must be a valid CPF number
- "61836182848" must not be a valid CPF number
