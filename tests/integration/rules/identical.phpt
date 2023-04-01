--CREDITS--
Henrique Moody <henriquemoody@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::identical(123)->check(321));
exceptionMessage(static fn() => v::not(v::identical(321))->check(321));
exceptionFullMessage(static fn() => v::identical(123)->assert(321));
exceptionFullMessage(static fn() => v::not(v::identical(321))->assert(321));
?>
--EXPECT--
321 must be identical as 123
321 must not be identical as 321
- 321 must be identical as 123
- 321 must not be identical as 321
