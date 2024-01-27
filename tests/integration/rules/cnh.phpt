--CREDITS--
William Espindola <oi@williamespindola.com.br>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::cnh()->check('batman'));
exceptionMessage(static fn() => v::not(v::cnh())->check('02650306461'));
exceptionFullMessage(static fn() => v::cnh()->assert('bruce wayne'));
exceptionFullMessage(static fn() => v::not(v::cnh())->assert('02650306461'));
?>
--EXPECT--
"batman" must be a valid CNH number
"02650306461" must not be a valid CNH number
- "bruce wayne" must be a valid CNH number
- "02650306461" must not be a valid CNH number
