--CREDITS--
William Espindola <oi@williamespindola.com.br>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::not(v::alwaysValid())->check(true));
exceptionFullMessage(static fn() => v::not(v::alwaysValid())->assert(true));
?>
--EXPECT--
`TRUE` is always invalid
- `TRUE` is always invalid
