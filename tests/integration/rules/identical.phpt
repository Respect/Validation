--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::identical(123)->assert(321));
exceptionMessage(static fn() => v::not(v::identical(321))->assert(321));
exceptionFullMessage(static fn() => v::identical(123)->assert(321));
exceptionFullMessage(static fn() => v::not(v::identical(321))->assert(321));
?>
--EXPECT--
321 must be identical to 123
321 must not be identical to 321
- 321 must be identical to 123
- 321 must not be identical to 321