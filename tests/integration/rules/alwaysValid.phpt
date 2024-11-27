--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::not(v::alwaysValid())->assert(true));
exceptionFullMessage(static fn() => v::not(v::alwaysValid())->assert(true));
?>
--EXPECT--
`true` is always invalid
- `true` is always invalid
