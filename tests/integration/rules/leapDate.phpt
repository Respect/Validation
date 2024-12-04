--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::leapDate('Y-m-d')->assert('1989-02-29'));
exceptionMessage(static fn() => v::not(v::leapDate('Y-m-d'))->assert('1988-02-29'));
exceptionFullMessage(static fn() => v::leapDate('Y-m-d')->assert('1990-02-29'));
exceptionFullMessage(static fn() => v::not(v::leapDate('Y-m-d'))->assert('1992-02-29'));
?>
--EXPECT--
"1989-02-29" must be a valid leap date
"1988-02-29" must not be a leap date
- "1990-02-29" must be a valid leap date
- "1992-02-29" must not be a leap date