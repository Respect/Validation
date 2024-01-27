--CREDITS--
Henrique Moody <henriquemoody@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::min(INF)->check(10));
exceptionMessage(static fn() => v::not(v::min(5))->check(INF));
exceptionFullMessage(static fn() => v::min('today')->assert('yesterday'));
exceptionFullMessage(static fn() => v::not(v::min('a'))->assert('z'));
?>
--EXPECT--
10 must be greater than or equal to `INF`
`INF` must not be greater than or equal to 5
- "yesterday" must be greater than or equal to "today"
- "z" must not be greater than or equal to "a"
