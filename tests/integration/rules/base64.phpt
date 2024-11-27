--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::base64()->assert('=c3VyZS4'));
exceptionMessage(static fn() => v::not(v::base64())->assert('c3VyZS4='));
exceptionFullMessage(static fn() => v::base64()->assert('=c3VyZS4'));
exceptionFullMessage(static fn() => v::not(v::base64())->assert('c3VyZS4='));
?>
--EXPECT--
"=c3VyZS4" must be Base64-encoded
"c3VyZS4=" must not be Base64-encoded
- "=c3VyZS4" must be Base64-encoded
- "c3VyZS4=" must not be Base64-encoded
