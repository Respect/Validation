--CREDITS--
Danilo Correa <danilosilva87@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::phone()->check('123'));
exceptionMessage(static fn() => v::not(v::phone())->check('+1 650 253 00 00'));
exceptionFullMessage(static fn() => v::phone()->assert('(555)5555 555'));
exceptionFullMessage(static fn() => v::not(v::phone())->assert('+55 11 91111 1111'));
?>
--EXPECT--
"123" must be a valid telephone number
"+1 650 253 00 00" must not be a valid telephone number
- "(555)5555 555" must be a valid telephone number
- "+55 11 91111 1111" must not be a valid telephone number
