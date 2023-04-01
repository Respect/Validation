--CREDITS--
Henrique Moody <henriquemoody@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::floatType()->check('42.33'));
exceptionMessage(static fn() => v::not(v::floatType())->check(INF));
exceptionFullMessage(static fn() => v::floatType()->assert(true));
exceptionFullMessage(static fn() => v::not(v::floatType())->assert(2.0));
?>
--EXPECT--
"42.33" must be of type float
`INF` must not be of type float
- `TRUE` must be of type float
- 2.0 must not be of type float
