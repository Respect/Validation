--CREDITS--
Henrique Moody <henriquemoody@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::max(10)->check(11));
exceptionMessage(static fn() => v::not(v::max(10))->check(5));
exceptionFullMessage(static fn() => v::max('today')->assert('tomorrow'));
exceptionFullMessage(static fn() => v::not(v::max('b'))->assert('a'));
?>
--EXPECT--
11 must be less than or equal to 10
5 must not be less than or equal to 10
- "tomorrow" must be less than or equal to "today"
- "a" must not be less than or equal to "b"
