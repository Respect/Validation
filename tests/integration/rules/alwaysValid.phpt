--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::not(v::alwaysValid())->assert(true));
exceptionFullMessage(static fn() => v::not(v::alwaysValid())->assert(true));
?>
--EXPECT--
`true` must be invalid
- `true` must be invalid