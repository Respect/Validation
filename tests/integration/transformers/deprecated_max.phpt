--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::max(10)->assert(11));
exceptionMessage(static fn() => v::not(v::max(10))->assert(5));
exceptionFullMessage(static fn() => v::max('today')->assert('tomorrow'));
exceptionFullMessage(static fn() => v::not(v::max('b'))->assert('a'));
?>
--EXPECTF--

Deprecated: Calling max() with a scalar value has been deprecated, and will be not allows in the next major version. Use lessThanOrEqual() instead. %s
11 must be less than or equal to 10

Deprecated: Calling max() with a scalar value has been deprecated, and will be not allows in the next major version. Use lessThanOrEqual() instead. %s
5 must be greater than 10

Deprecated: Calling max() with a scalar value has been deprecated, and will be not allows in the next major version. Use lessThanOrEqual() instead. %s
- "tomorrow" must be less than or equal to "today"

Deprecated: Calling max() with a scalar value has been deprecated, and will be not allows in the next major version. Use lessThanOrEqual() instead. %s
- "a" must be greater than "b"
