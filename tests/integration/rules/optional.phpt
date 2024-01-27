--CREDITS--
Henrique Moody <henriquemoody@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::optional(v::alpha())->check(1234));
exceptionMessage(static fn() => v::optional(v::alpha())->setName('Name')->check(1234));
exceptionMessage(static fn() => v::not(v::optional(v::alpha()))->check('abcd'));
exceptionMessage(static fn() => v::not(v::optional(v::alpha()))->setName('Name')->check('abcd'));
exceptionFullMessage(static fn() => v::optional(v::alpha())->assert(1234));
exceptionFullMessage(static fn() => v::optional(v::alpha())->setName('Name')->assert(1234));
exceptionFullMessage(static fn() => v::not(v::optional(v::alpha()))->assert('abcd'));
exceptionFullMessage(static fn() => v::not(v::optional(v::alpha()))->setName('Name')->assert('abcd'));
?>
--EXPECT--
1234 must contain only letters (a-z)
Name must contain only letters (a-z)
The value must not be optional
Name must not be optional
- 1234 must contain only letters (a-z)
- Name must contain only letters (a-z)
- The value must not be optional
- Name must not be optional
