--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::min(INF)->assert(10));
exceptionMessage(static fn() => v::not(v::min(5))->assert(INF));
exceptionFullMessage(static fn() => v::min('today')->assert('yesterday'));
exceptionFullMessage(static fn() => v::not(v::min('a'))->assert('z'));
?>
--EXPECTF--

Deprecated: Calling min() with a scalar value has been deprecated, and will be not allows in the next major version. Use greaterThanOrEqual() instead. in %s
10 must be greater than or equal to `INF`

Deprecated: Calling min() with a scalar value has been deprecated, and will be not allows in the next major version. Use greaterThanOrEqual() instead. in %s
`INF` must not be greater than or equal to 5

Deprecated: Calling min() with a scalar value has been deprecated, and will be not allows in the next major version. Use greaterThanOrEqual() instead. in %s
- "yesterday" must be greater than or equal to "today"

Deprecated: Calling min() with a scalar value has been deprecated, and will be not allows in the next major version. Use greaterThanOrEqual() instead. in %s
- "z" must not be greater than or equal to "a"
