--CREDITS--
Danilo Benevides <danilobenevides01@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::leapDate('Y-m-d')->check('1989-02-29'));
exceptionMessage(static fn() => v::not(v::leapDate('Y-m-d'))->check('1988-02-29'));
exceptionFullMessage(static fn() => v::leapDate('Y-m-d')->assert('1990-02-29'));
exceptionFullMessage(static fn() => v::not(v::leapDate('Y-m-d'))->assert('1992-02-29'));
?>
--EXPECT--
"1989-02-29" must be leap date
"1988-02-29" must not be leap date
- "1990-02-29" must be leap date
- "1992-02-29" must not be leap date
