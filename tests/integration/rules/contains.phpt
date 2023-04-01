--CREDITS--
William Espindola <oi@williamespindola.com.br>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::contains('foo')->check('bar'));
exceptionMessage(static fn() => v::not(v::contains('foo'))->check('fool'));
exceptionFullMessage(static fn() => v::contains('foo')->assert(['bar']));
exceptionFullMessage(static fn() => v::not(v::contains('foo', true))->assert(['bar', 'foo']));
?>
--EXPECT--
"bar" must contain the value "foo"
"fool" must not contain the value "foo"
- `{ "bar" }` must contain the value "foo"
- `{ "bar", "foo" }` must not contain the value "foo"
