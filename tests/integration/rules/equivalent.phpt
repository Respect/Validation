--CREDITS--
Henrique Moody <henriquemoody@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::equivalent(true)->check(false));
exceptionMessage(static fn() => v::not(v::equivalent('Something'))->check('someThing'));
exceptionFullMessage(static fn() => v::equivalent(123)->assert('true'));
exceptionFullMessage(static fn() => v::not(v::equivalent(true))->assert(1));
?>
--EXPECT--
`FALSE` must be equivalent to `TRUE`
"someThing" must not be equivalent to "Something"
- "true" must be equivalent to 123
- 1 must not be equivalent to `TRUE`
