--FILE--
<?php

require_once 'vendor/autoload.php';

exceptionMessage(static fn() => v::polishIdCard()->assert('AYE205411'));
exceptionMessage(static fn() => v::not(v::polishIdCard())->assert('AYE205410'));
exceptionFullMessage(static fn() => v::polishIdCard()->assert('AYE205411'));
exceptionFullMessage(static fn() => v::not(v::polishIdCard())->assert('AYE205410'));
?>
--EXPECT--
"AYE205411" must be a valid Polish Identity Card number
"AYE205410" must not be a valid Polish Identity Card number
- "AYE205411" must be a valid Polish Identity Card number
- "AYE205410" must not be a valid Polish Identity Card number
