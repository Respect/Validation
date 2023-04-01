--CREDITS--
Henrique Moody <henriquemoody@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

date_default_timezone_set('UTC');

exceptionMessage(static fn() => v::dateTime()->check('FooBarBazz'));
exceptionMessage(static fn() => v::dateTime('c')->check('06-12-1995'));
exceptionFullMessage(static fn() => v::dateTime()->assert('QuxQuuxx'));
exceptionFullMessage(static fn() => v::dateTime('r')->assert(2018013030));
exceptionMessage(static fn() => v::not(v::dateTime())->check('4 days ago'));
exceptionMessage(static fn() => v::not(v::dateTime('Y-m-d'))->check('1988-09-09'));
exceptionFullMessage(static fn() => v::not(v::dateTime())->assert('+3 weeks'));
exceptionFullMessage(static fn() => v::not(v::dateTime('d/m/y'))->assert('23/07/99'));
?>
--EXPECT--
"FooBarBazz" must be a valid date/time
"06-12-1995" must be a valid date/time in the format "2005-12-30T01:02:03+00:00"
- "QuxQuuxx" must be a valid date/time
- 2018013030 must be a valid date/time in the format "Fri, 30 Dec 2005 01:02:03 +0000"
"4 days ago" must not be a valid date/time
"1988-09-09" must not be a valid date/time in the format "2005-12-30"
- "+3 weeks" must not be a valid date/time
- "23/07/99" must not be a valid date/time in the format "30/12/05"
