--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::hexRgbColor()->assert('invalid'));
exceptionMessage(static fn() => v::not(v::hexRgbColor())->assert('#808080'));
exceptionFullMessage(static fn() => v::hexRgbColor()->assert('invalid'));
exceptionFullMessage(static fn() => v::not(v::hexRgbColor())->assert('#808080'));
?>
--EXPECT--
"invalid" must be a hex RGB color
"#808080" must not be a hex RGB color
- "invalid" must be a hex RGB color
- "#808080" must not be a hex RGB color
