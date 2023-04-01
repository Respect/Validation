--CREDITS--
William Espindola <oi@williamespindola.com.br>
--FILE--
<?php

declare(strict_types=1);

require_once 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::cnpj()->check('não cnpj'));
exceptionMessage(static fn() => v::not(v::cnpj())->check('65.150.175/0001-20'));
exceptionFullMessage(static fn() => v::cnpj()->assert('test'));
exceptionFullMessage(static fn() => v::not(v::cnpj())->assert('65.150.175/0001-20'));
?>
--EXPECT--
"não cnpj" must be a valid CNPJ number
"65.150.175/0001-20" must not be a valid CNPJ number
- "test" must be a valid CNPJ number
- "65.150.175/0001-20" must not be a valid CNPJ number
