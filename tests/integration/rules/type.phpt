--CREDITS--
Paul Karikari <paulkarikari1@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::type('integer')->check('42'));
exceptionMessage(static fn() => v::not(v::type('string'))->check('foo'));
exceptionFullMessage(static fn() => v::type('double')->assert(20));
exceptionFullMessage(static fn() => v::not(v::type('bool'))->assert(true));
?>
--EXPECT--
"42" must be "integer"
"foo" must not be "string"
- 20 must be "double"
- `TRUE` must not be "bool"
