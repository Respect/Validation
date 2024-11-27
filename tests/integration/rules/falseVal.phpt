--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::falseVal()->assert(true));
exceptionMessage(static fn() => v::not(v::falseVal())->assert('false'));
exceptionFullMessage(static fn() => v::falseVal()->assert(1));
exceptionFullMessage(static fn() => v::not(v::falseVal())->assert(0));
?>
--EXPECT--
`true` must evaluate to `false`
"false" must not evaluate to `false`
- 1 must evaluate to `false`
- 0 must not evaluate to `false`
