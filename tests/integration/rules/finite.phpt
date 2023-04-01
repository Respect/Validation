--CREDITS--
Danilo Correa <danilosilva87@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::finite()->check(''));
exceptionMessage(static fn() => v::not(v::finite())->check(10));
exceptionFullMessage(static fn() => v::finite()->assert([12]));
exceptionFullMessage(static fn() => v::not(v::finite())->assert('123456'));
?>
--EXPECT--
"" must be a finite number
10 must not be a finite number
- `{ 12 }` must be a finite number
- "123456" must not be a finite number
