--CREDITS--
William Espindola <oi@williamespindola.com.br>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::currencyCode()->check('batman'));
exceptionMessage(static fn() => v::not(v::currencyCode())->check('BRL'));
exceptionFullMessage(static fn() => v::currencyCode()->assert('ppz'));
exceptionFullMessage(static fn() => v::not(v::currencyCode())->assert('GBP'));
?>
--EXPECT--
"batman" must be a valid currency
"BRL" must not be a valid currency
- "ppz" must be a valid currency
- "GBP" must not be a valid currency
