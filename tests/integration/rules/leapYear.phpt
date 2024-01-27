--CREDITS--
Danilo Correa <danilosilva87@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::leapYear()->check('2009'));
exceptionMessage(static fn() => v::not(v::leapYear())->check('2008'));
exceptionFullMessage(static fn() => v::leapYear()->assert('2009-02-29'));
exceptionFullMessage(static fn() => v::not(v::leapYear())->assert('2008'));
?>
--EXPECT--
"2009" must be a leap year
"2008" must not be a leap year
- "2009-02-29" must be a leap year
- "2008" must not be a leap year
