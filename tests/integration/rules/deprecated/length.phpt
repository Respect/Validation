--FILE--
<?php

declare(strict_types=1);

require_once 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::length(0, 5, false)->check('forest'));
exceptionMessage(static fn() => v::length(10, 20)->check('river'));
exceptionMessage(static fn() => v::length(15, null, false)->check('mountain'));
exceptionMessage(static fn() => v::length(20)->check('ocean'));
exceptionMessage(static fn() => v::length(2, 5)->check('desert'));
exceptionMessage(static fn() => v::not(v::length(0, 15))->check('rainforest'));
exceptionMessage(static fn() => v::not(v::length(0, 20, false))->check('glacier'));
exceptionMessage(static fn() => v::not(v::length(3, null))->check('meadow'));
exceptionMessage(static fn() => v::not(v::length(5, null, false))->check('volcano'));
exceptionMessage(static fn() => v::not(v::length(5, 20))->check('canyon'));
exceptionFullMessage(static fn() => v::length(0, 5, false)->assert('prairie'));
exceptionFullMessage(static fn() => v::length(0, 5)->assert('wetland'));
exceptionFullMessage(static fn() => v::length(15, null, false)->assert('tundra'));
exceptionFullMessage(static fn() => v::length(20)->assert('savanna'));
exceptionFullMessage(static fn() => v::length(7, 10)->assert('marsh'));
exceptionFullMessage(static fn() => v::length(4, 10, false)->assert('reef'));
exceptionFullMessage(static fn() => v::not(v::length(0, 15))->assert('valley'));
exceptionFullMessage(static fn() => v::not(v::length(0, 20, false))->assert('island'));
exceptionFullMessage(static fn() => v::not(v::length(5, null))->assert('plateau'));
exceptionFullMessage(static fn() => v::not(v::length(3, null, false))->assert('fjord'));
exceptionFullMessage(static fn() => v::not(v::length(5, 20))->assert('delta'));
exceptionFullMessage(static fn() => v::not(v::length(5, 11, false))->assert('waterfall'));
exceptionFullMessage(static fn() => v::length(8, 8)->assert('estuary'));
exceptionFullMessage(static fn() => v::not(v::length(5, 5))->assert('grove'));
// phpcs:disable Generic.Files.LineLength.TooLong
?>
--EXPECTF--

Deprecated: Calling length() with scalar values has been deprecated, and will not be allowed in the next major version. Use length(lessThan(5)) instead. in %s
The length of "forest" must be less than 5

Deprecated: Calling length() with scalar values has been deprecated, and will not be allowed in the next major version. Use length(between(10, 20)) instead. in %s
The length of "river" must be between 10 and 20

Deprecated: Calling length() with scalar values has been deprecated, and will not be allowed in the next major version. Use length(greaterThan(15)) instead. in %s
The length of "mountain" must be greater than 15

Deprecated: Calling length() with scalar values has been deprecated, and will not be allowed in the next major version. Use length(greaterThanOrEqual(20)) instead. in %s
The length of "ocean" must be greater than or equal to 20

Deprecated: Calling length() with scalar values has been deprecated, and will not be allowed in the next major version. Use length(between(2, 5)) instead. in %s
The length of "desert" must be between 2 and 5

Deprecated: Calling length() with scalar values has been deprecated, and will not be allowed in the next major version. Use length(lessThanOrEqual(15)) instead. in %s
The length of "rainforest" must not be less than or equal to 15

Deprecated: Calling length() with scalar values has been deprecated, and will not be allowed in the next major version. Use length(lessThan(20)) instead. in %s
The length of "glacier" must not be less than 20

Deprecated: Calling length() with scalar values has been deprecated, and will not be allowed in the next major version. Use length(greaterThanOrEqual(3)) instead. in %s
The length of "meadow" must not be greater than or equal to 3

Deprecated: Calling length() with scalar values has been deprecated, and will not be allowed in the next major version. Use length(greaterThan(5)) instead. in %s
The length of "volcano" must not be greater than 5

Deprecated: Calling length() with scalar values has been deprecated, and will not be allowed in the next major version. Use length(between(5, 20)) instead. in %s
The length of "canyon" must not be between 5 and 20

Deprecated: Calling length() with scalar values has been deprecated, and will not be allowed in the next major version. Use length(lessThan(5)) instead. in %s
- The length of "prairie" must be less than 5

Deprecated: Calling length() with scalar values has been deprecated, and will not be allowed in the next major version. Use length(lessThanOrEqual(5)) instead. in %s
- The length of "wetland" must be less than or equal to 5

Deprecated: Calling length() with scalar values has been deprecated, and will not be allowed in the next major version. Use length(greaterThan(15)) instead. in %s
- The length of "tundra" must be greater than 15

Deprecated: Calling length() with scalar values has been deprecated, and will not be allowed in the next major version. Use length(greaterThanOrEqual(20)) instead. in %s
- The length of "savanna" must be greater than or equal to 20

Deprecated: Calling length() with scalar values has been deprecated, and will not be allowed in the next major version. Use length(between(7, 10)) instead. in %s
- The length of "marsh" must be between 7 and 10

Deprecated: Calling length() with scalar values has been deprecated, and will not be allowed in the next major version. Use length(betweenExclusive(4, 10)) instead. in %s
- The length of "reef" must be greater than 4 and less than 10

Deprecated: Calling length() with scalar values has been deprecated, and will not be allowed in the next major version. Use length(lessThanOrEqual(15)) instead. in %s
- The length of "valley" must not be less than or equal to 15

Deprecated: Calling length() with scalar values has been deprecated, and will not be allowed in the next major version. Use length(lessThan(20)) instead. in %s
- The length of "island" must not be less than 20

Deprecated: Calling length() with scalar values has been deprecated, and will not be allowed in the next major version. Use length(greaterThanOrEqual(5)) instead. in %s
- The length of "plateau" must not be greater than or equal to 5

Deprecated: Calling length() with scalar values has been deprecated, and will not be allowed in the next major version. Use length(greaterThan(3)) instead. in %s
- The length of "fjord" must not be greater than 3

Deprecated: Calling length() with scalar values has been deprecated, and will not be allowed in the next major version. Use length(between(5, 20)) instead. in %s
- The length of "delta" must not be between 5 and 20

Deprecated: Calling length() with scalar values has been deprecated, and will not be allowed in the next major version. Use length(betweenExclusive(5, 11)) instead. in %s
- The length of "waterfall" must not be greater than 5 and less than 11

Deprecated: Calling length() with scalar values has been deprecated, and will not be allowed in the next major version. Use length(equals(8)) instead. in %s
- The length of "estuary" must equal 8

Deprecated: Calling length() with scalar values has been deprecated, and will not be allowed in the next major version. Use length(equals(5)) instead. in %s
- The length of "grove" must not equal 5
