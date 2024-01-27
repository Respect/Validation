--CREDITS--
Henrique Moody <henriquemoody@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::equals(123)->check(321));
exceptionMessage(static fn() => v::not(v::equals(321))->check(321));
exceptionFullMessage(static fn() => v::equals(123)->assert(321));
exceptionFullMessage(static fn() => v::not(v::equals(321))->assert(321));
?>
--EXPECT--
321 must equal 123
321 must not equal 321
- 321 must equal 123
- 321 must not equal 321
