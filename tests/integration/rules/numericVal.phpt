--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::numericVal()->check('a'));
exceptionMessage(static fn() => v::not(v::numericVal())->check('1'));
exceptionFullMessage(static fn() => v::numericVal()->assert('a'));
exceptionFullMessage(static fn() => v::not(v::numericVal())->assert('1'));
?>
--EXPECT--
"a" must be numeric
"1" must not be numeric
- "a" must be numeric
- "1" must not be numeric
