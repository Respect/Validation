--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::min(INF)->assert(10));
exceptionMessage(static fn() => v::not(v::min(5))->assert(INF));
exceptionFullMessage(static fn() => v::min('today')->assert('yesterday'));
exceptionFullMessage(static fn() => v::not(v::min('a'))->assert('z'));
?>
--EXPECTF--

Deprecated: Calling min() with a scalar value has been deprecated, and will be not allows in the next major version. Use greaterThanOrEqual() instead. %s
10 must be greater than or equal to `INF`

Deprecated: Calling min() with a scalar value has been deprecated, and will be not allows in the next major version. Use greaterThanOrEqual() instead. %s
`INF` must be less than 5

Deprecated: Calling min() with a scalar value has been deprecated, and will be not allows in the next major version. Use greaterThanOrEqual() instead. %s
- "yesterday" must be greater than or equal to "today"

Deprecated: Calling min() with a scalar value has been deprecated, and will be not allows in the next major version. Use greaterThanOrEqual() instead. %s
- "z" must be less than "a"
