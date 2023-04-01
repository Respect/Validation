--CREDITS--
William Espindola <oi@williamespindola.com.br>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::endsWith('foo')->check('bar'));
exceptionMessage(static fn() => v::not(v::endsWith('foo'))->check(['bar', 'foo']));
exceptionFullMessage(static fn() => v::endsWith('foo')->assert(''));
exceptionFullMessage(static fn() => v::not(v::endsWith('foo'))->assert(['bar', 'foo']));
?>
--EXPECT--
"bar" must end with "foo"
`{ "bar", "foo" }` must not end with "foo"
- "" must end with "foo"
- `{ "bar", "foo" }` must not end with "foo"
