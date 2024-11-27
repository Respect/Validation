--FILE--
<?php

require 'vendor/autoload.php';

date_default_timezone_set('UTC');

exceptionMessage(static fn() => v::time()->assert('2018-01-30'));
exceptionMessage(static fn() => v::not(v::time())->assert('09:25:46'));
exceptionFullMessage(static fn() => v::time()->assert('2018-01-30'));
exceptionFullMessage(static fn() => v::not(v::time('g:i A'))->assert('8:13 AM'));
?>
--EXPECT--
"2018-01-30" must be a valid time in the format "23:59:59"
"09:25:46" must not be a valid time in the format "23:59:59"
- "2018-01-30" must be a valid time in the format "23:59:59"
- "8:13 AM" must not be a valid time in the format "11:59 PM"
