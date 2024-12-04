--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::base64()->assert('=c3VyZS4'));
exceptionMessage(static fn() => v::not(v::base64())->assert('c3VyZS4='));
exceptionFullMessage(static fn() => v::base64()->assert('=c3VyZS4'));
exceptionFullMessage(static fn() => v::not(v::base64())->assert('c3VyZS4='));
?>
--EXPECT--
"=c3VyZS4" must be a base64 encoded string
"c3VyZS4=" must not be a base64 encoded string
- "=c3VyZS4" must be a base64 encoded string
- "c3VyZS4=" must not be a base64 encoded string