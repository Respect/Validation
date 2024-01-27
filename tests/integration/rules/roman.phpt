--CREDITS--
Henrique Moody <henriquemoody@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::roman()->check(1234));
exceptionMessage(static fn() => v::not(v::roman())->check('XL'));
exceptionFullMessage(static fn() => v::roman()->assert('e2'));
exceptionFullMessage(static fn() => v::not(v::roman())->assert('IV'));
?>
--EXPECT--
1234 must be a valid Roman numeral
"XL" must not be a valid Roman numeral
- "e2" must be a valid Roman numeral
- "IV" must not be a valid Roman numeral
