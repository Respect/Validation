--TEST--
PhpLabel rule exception should not be thrown for valid inputs
--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::phpLabel()->assert('f o o'));
exceptionMessage(static fn() => v::not(v::phpLabel())->assert('correctOne'));
exceptionFullMessage(static fn() => v::phpLabel()->assert('0wner'));
exceptionFullMessage(static fn() => v::not(v::phpLabel())->assert('Respect'));
?>
--EXPECT--
"f o o" must be a valid PHP label
"correctOne" must not be a valid PHP label
- "0wner" must be a valid PHP label
- "Respect" must not be a valid PHP label
