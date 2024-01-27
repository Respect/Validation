--CREDITS--
Henrique Moody <henriquemoody@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::containsAny(['foo', 'bar'])->check('baz'));
exceptionMessage(static fn() => v::not(v::containsAny(['foo', 'bar']))->check('fool'));
exceptionFullMessage(static fn() => v::containsAny(['foo', 'bar'])->assert(['baz']));
exceptionFullMessage(static fn() => v::not(v::containsAny(['foo', 'bar'], true))->assert(['bar', 'foo']));
?>
--EXPECT--
"baz" must contain at least one of the values `{ "foo", "bar" }`
"fool" must not contain any of the values `{ "foo", "bar" }`
- `{ "baz" }` must contain at least one of the values `{ "foo", "bar" }`
- `{ "bar", "foo" }` must not contain any of the values `{ "foo", "bar" }`
