--CREDITS--
Henrique Moody <henriquemoody@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::between(1, 2)->check(0));
exceptionMessage(static fn() => v::not(v::between('yesterday', 'tomorrow'))->check('today'));
exceptionFullMessage(static fn() => v::between('a', 'c')->assert('d'));
exceptionFullMessage(static fn() => v::not(v::between(-INF, INF))->assert(0));
?>
--EXPECT--
0 must be between 1 and 2
"today" must not be between "yesterday" and "tomorrow"
- "d" must be between "a" and "c"
- 0 must not be between `-INF` and `INF`
