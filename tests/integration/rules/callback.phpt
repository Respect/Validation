--CREDITS--
William Espindola <oi@williamespindola.com.br>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::callback('is_string')->check([]));
exceptionMessage(static fn() => v::not(v::callback('is_string'))->check('foo'));
exceptionFullMessage(static fn() => v::callback('is_string')->assert(true));
exceptionFullMessage(static fn() => v::not(v::callback('is_string'))->assert('foo'));
?>
--EXPECT--
`{ }` must be valid
"foo" must not be valid
- `TRUE` must be valid
- "foo" must not be valid
