--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::alwaysInvalid()->check('whatever'));
exceptionFullMessage(static fn() => v::alwaysInvalid()->assert(''));
?>
--EXPECT--
"whatever" is always invalid
- "" is always invalid
