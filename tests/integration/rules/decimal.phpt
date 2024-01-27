--CREDITS--
Henrique Moody <henriquemoody@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::decimal(3)->check(0.1234));
exceptionFullMessage(static fn() => v::decimal(2)->assert(0.123));
exceptionMessage(static fn() => v::not(v::decimal(5))->check(0.12345));
exceptionFullMessage(static fn() => v::not(v::decimal(2))->assert(0.34));
?>
--EXPECT--
0.1234 must have 3 decimals
- 0.123 must have 2 decimals
0.12345 must not have 5 decimals
- 0.34 must not have 2 decimals
