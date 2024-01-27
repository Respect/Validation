--CREDITS--
William Espindola <oi@williamespindola.com.br>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::base(61)->check('Z01xSsg5675hic20dj'));
exceptionFullMessage(static fn() => v::base(2)->assert(''));
exceptionMessage(static fn() => v::not(v::base(2))->check('011010001'));
exceptionFullMessage(static fn() => v::not(v::base(2))->assert('011010001'));
?>
--EXPECT--
"Z01xSsg5675hic20dj" must be a number in the base 61
- "" must be a number in the base 2
"011010001" must not be a number in the base 2
- "011010001" must not be a number in the base 2
