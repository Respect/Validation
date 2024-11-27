--FILE--
<?php

require_once 'vendor/autoload.php';

exceptionMessage(static fn() => v::cnpj()->assert('não cnpj'));
exceptionMessage(static fn() => v::not(v::cnpj())->assert('65.150.175/0001-20'));
exceptionFullMessage(static fn() => v::cnpj()->assert('test'));
exceptionFullMessage(static fn() => v::not(v::cnpj())->assert('65.150.175/0001-20'));
?>
--EXPECT--
"não cnpj" must be a valid CNPJ number
"65.150.175/0001-20" must not be a valid CNPJ number
- "test" must be a valid CNPJ number
- "65.150.175/0001-20" must not be a valid CNPJ number
