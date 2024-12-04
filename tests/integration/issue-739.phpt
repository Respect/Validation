--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::when(v::alwaysInvalid(), v::alwaysValid())->assert('foo'));
?>
--EXPECT--
"foo" is invalid