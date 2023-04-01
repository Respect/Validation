--CREDITS--
Henrique Moody <henriquemoody@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::nullType()->check(''));
exceptionMessage(static fn() => v::not(v::nullType())->check(null));
exceptionFullMessage(static fn() => v::nullType()->assert(false));
exceptionFullMessage(static fn() => v::not(v::nullType())->assert(null));
?>
--EXPECT--
"" must be null
`NULL` must not be null
- `FALSE` must be null
- `NULL` must not be null
