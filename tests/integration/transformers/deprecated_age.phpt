--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

date_default_timezone_set('UTC');

exceptionMessage(static fn() => v::minAge(18)->check('17 years ago'));
exceptionMessage(static fn() => v::not(v::minAge(18))->check('-30 years'));
exceptionFullMessage(static fn() => v::minAge(18)->assert('yesterday'));
exceptionFullMessage(static fn() => v::minAge(18, 'd/m/Y')->assert('12/10/2010'));
exceptionMessage(static fn() => v::maxAge(12)->check('50 years ago'));
exceptionMessage(static fn() => v::not(v::maxAge(12))->check('11 years ago'));
exceptionFullMessage(static fn() => v::maxAge(12, 'Y-m-d')->assert('1988-09-09'));
exceptionFullMessage(static fn() => v::not(v::maxAge(12, 'Y-m-d'))->assert('2018-01-01'));
// phpcs:disable Generic.Files.LineLength.TooLong
?>
--EXPECTF--

Deprecated: The minAge() rule has been deprecated and will be removed in the next major version. Use dateTimeDiff() instead. in %s
The number of years between now and 17 years ago must be greater than or equal to 18

Deprecated: The minAge() rule has been deprecated and will be removed in the next major version. Use dateTimeDiff() instead. in %s
The number of years between now and -30 years must not be greater than or equal to 18

Deprecated: The minAge() rule has been deprecated and will be removed in the next major version. Use dateTimeDiff() instead. in %s
- The number of years between now and yesterday must be greater than or equal to 18

Deprecated: The minAge() rule has been deprecated and will be removed in the next major version. Use dateTimeDiff() instead. in %s
- The number of years between now and 12/10/2010 must be greater than or equal to 18

Deprecated: The maxAge() rule has been deprecated and will be removed in the next major version. Use dateTimeDiff() instead. in %s
The number of years between now and 50 years ago must be less than or equal to 12

Deprecated: The maxAge() rule has been deprecated and will be removed in the next major version. Use dateTimeDiff() instead. in %s
The number of years between now and 11 years ago must not be less than or equal to 12

Deprecated: The maxAge() rule has been deprecated and will be removed in the next major version. Use dateTimeDiff() instead. in %s
- The number of years between now and 1988-09-09 must be less than or equal to 12

Deprecated: The maxAge() rule has been deprecated and will be removed in the next major version. Use dateTimeDiff() instead. in %s
- The number of years between now and 2018-01-01 must not be less than or equal to 12
