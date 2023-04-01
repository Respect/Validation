--CREDITS--
Danilo Correa <danilosilva87@gmail.com>
Emmerson Siqueira <emmersonsiqueira@gmail.com>
--TEST--
PhpLabel rule exception should not be thrown for valid inputs
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::phpLabel()->check('f o o'));
exceptionMessage(static fn() => v::not(v::phpLabel())->check('correctOne'));
exceptionFullMessage(static fn() => v::phpLabel()->assert('0wner'));
exceptionFullMessage(static fn() => v::not(v::phpLabel())->assert('Respect'));
?>
--EXPECT--
"f o o" must be a valid PHP label
"correctOne" must not be a valid PHP label
- "0wner" must be a valid PHP label
- "Respect" must not be a valid PHP label
