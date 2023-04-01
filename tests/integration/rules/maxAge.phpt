--CREDITS--
Emmerson Siqueira <emmersonsiqueira@gmail.com>
Henrique Moody <henriquemoody@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::maxAge(12)->check('50 years ago'));
exceptionMessage(static fn() => v::not(v::maxAge(12))->check('11 years ago'));
exceptionFullMessage(static fn() => v::maxAge(12, 'Y-m-d')->assert('1988-09-09'));
exceptionFullMessage(static fn() => v::not(v::maxAge(12, 'Y-m-d'))->assert('2018-01-01'));
?>
--EXPECT--
"50 years ago" must be 12 years or less
"11 years ago" must not be 12 years or less
- "1988-09-09" must be 12 years or less
- "2018-01-01" must not be 12 years or less
