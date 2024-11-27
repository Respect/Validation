--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::boolVal()->assert('ok'));
exceptionMessage(static fn() => v::not(v::boolVal())->assert('yes'));
exceptionFullMessage(static fn() => v::boolVal()->assert('yep'));
exceptionFullMessage(static fn() => v::not(v::boolVal())->assert('on'));
?>
--EXPECT--
"ok" must be a boolean value
"yes" must not be a boolean value
- "yep" must be a boolean value
- "on" must not be a boolean value
