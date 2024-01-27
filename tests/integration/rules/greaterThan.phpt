--CREDITS--
Henrique Moody <henriquemoody@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::greaterThan(21)->check(12));
exceptionMessage(static fn() => v::not(v::greaterThan('yesterday'))->check('today'));
exceptionFullMessage(static fn() => v::greaterThan('2018-09-09')->assert('1988-09-09'));
exceptionFullMessage(static fn() => v::not(v::greaterThan('a'))->assert('ba'));
?>
--EXPECT--
12 must be greater than 21
"today" must not be greater than "yesterday"
- "1988-09-09" must be greater than "2018-09-09"
- "ba" must not be greater than "a"
