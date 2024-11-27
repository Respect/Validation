--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::filterVar(FILTER_VALIDATE_IP)->assert(42));
exceptionMessage(static fn() => v::not(v::filterVar(FILTER_VALIDATE_BOOLEAN))->assert('On'));
exceptionFullMessage(static fn() => v::filterVar(FILTER_VALIDATE_EMAIL)->assert(1.5));
exceptionFullMessage(static fn() => v::not(v::filterVar(FILTER_VALIDATE_FLOAT))->assert(1.0));
?>
--EXPECT--
42 must be valid
"On" must not be valid
- 1.5 must be valid
- 1.0 must not be valid
