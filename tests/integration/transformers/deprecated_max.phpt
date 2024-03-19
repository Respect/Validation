--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::max(10)->check(11));
exceptionMessage(static fn() => v::not(v::max(10))->check(5));
exceptionFullMessage(static fn() => v::max('today')->assert('tomorrow'));
exceptionFullMessage(static fn() => v::not(v::max('b'))->assert('a'));
// phpcs:disable Generic.Files.LineLength.TooLong
?>
--EXPECTF--

Deprecated: Calling max() with a scalar value has been deprecated, and will be not allows in the next major version. Use lessThanOrEqual() instead. in %s
11 must be less than or equal to 10

Deprecated: Calling max() with a scalar value has been deprecated, and will be not allows in the next major version. Use lessThanOrEqual() instead. in %s
5 must not be less than or equal to 10

Deprecated: Calling max() with a scalar value has been deprecated, and will be not allows in the next major version. Use lessThanOrEqual() instead. in %s
- "tomorrow" must be less than or equal to "today"

Deprecated: Calling max() with a scalar value has been deprecated, and will be not allows in the next major version. Use lessThanOrEqual() instead. in %s
- "a" must not be less than or equal to "b"
