--CREDITS--
Henrique Moody <henriquemoody@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::containsCount('a', 3)->check('banana!banana'));
exceptionMessage(static fn() => v::not(v::containsCount('a', 3))->check('banana'));
exceptionFullMessage(static fn() => v::containsCount('foo', 2)->assert(['foo']));
exceptionFullMessage(static fn() => v::not(v::containsCount('foo', 1))->assert(['foo']));
?>
--EXPECT--
"banana!banana" must contain "a" 3 time(s)
"banana" must not contain "a" 3 time(s)
- `{ "foo" }` must contain "foo" 2 time(s)
- `{ "foo" }` must not contain "foo" 1 time(s)
