--CREDITS--
Emmerson Siqueira <emmersonsiqueira@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::printable()->check(''));
exceptionMessage(static fn() => v::not(v::printable())->check('abc'));
exceptionFullMessage(static fn() => v::printable()->assert('foo' . chr(10) . 'bar'));
exceptionFullMessage(static fn() => v::not(v::printable())->assert('$%asd'));
?>
--EXPECT--
"" must contain only printable characters
"abc" must not contain printable characters
- "foo\nbar" must contain only printable characters
- "$%asd" must not contain printable characters
