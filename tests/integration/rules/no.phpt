--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::not(v::no())->assert('No'));
exceptionMessage(static fn() => v::no()->assert('Yes'));
exceptionFullMessage(static fn() => v::not(v::no())->assert('No'));
exceptionFullMessage(static fn() => v::no()->assert('Yes'));
?>
--EXPECT--
"No" must not be similar to "No"
"Yes" must be similar to "No"
- "No" must not be similar to "No"
- "Yes" must be similar to "No"
