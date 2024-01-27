--CREDITS--
Bram Van der Sype <bram.vandersype@gmail.com>
Henrique Moody <henriquemoody@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::notEmpty()->check(null));
exceptionMessage(static fn() => v::notEmpty()->setName('Field')->check(null));
exceptionMessage(static fn() => v::not(v::notEmpty())->check(1));
exceptionFullMessage(static fn() => v::notEmpty()->assert(''));
exceptionFullMessage(static fn() => v::notEmpty()->setName('Field')->assert(''));
exceptionFullMessage(static fn() => v::not(v::notEmpty())->assert([1]));
?>
--EXPECT--
The value must not be empty
Field must not be empty
1 must be empty
- The value must not be empty
- Field must not be empty
- `{ 1 }` must be empty
