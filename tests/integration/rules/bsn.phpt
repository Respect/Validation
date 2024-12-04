--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::bsn()->assert('acb'));
exceptionMessage(static fn() => v::not(v::bsn())->assert('612890053'));
exceptionFullMessage(static fn() => v::bsn()->assert('abc'));
exceptionFullMessage(static fn() => v::not(v::bsn())->assert('612890053'));
?>
--EXPECT--
"acb" must be a valid BSN
"612890053" must not be a valid BSN
- "abc" must be a valid BSN
- "612890053" must not be a valid BSN