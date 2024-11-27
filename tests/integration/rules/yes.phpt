--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::not(v::yes())->assert('Yes'));
exceptionMessage(static fn() => v::yes()->assert('si'));
exceptionFullMessage(static fn() => v::not(v::yes())->assert('Yes'));
exceptionFullMessage(static fn() => v::yes()->assert('si'));
?>
--EXPECT--
"Yes" must not be similar to "Yes"
"si" must be similar to "Yes"
- "Yes" must not be similar to "Yes"
- "si" must be similar to "Yes"
