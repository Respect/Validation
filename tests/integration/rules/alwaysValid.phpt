--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::not(v::alwaysValid())->check(true));
exceptionFullMessage(static fn() => v::not(v::alwaysValid())->assert(true));
?>
--EXPECT--
`true` is always invalid
- `true` is always invalid
