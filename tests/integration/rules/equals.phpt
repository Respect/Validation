--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::equals(123)->assert(321));
exceptionMessage(static fn() => v::not(v::equals(321))->assert(321));
exceptionFullMessage(static fn() => v::equals(123)->assert(321));
exceptionFullMessage(static fn() => v::not(v::equals(321))->assert(321));
?>
--EXPECT--
321 must be equal to 123
321 must not be equal to 321
- 321 must be equal to 123
- 321 must not be equal to 321