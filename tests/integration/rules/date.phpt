--CREDITS--
Henrique Moody <henriquemoody@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

date_default_timezone_set('UTC');

exceptionMessage(static fn() => v::date()->check('2018-01-29T08:32:54+00:00'));
exceptionMessage(static fn() => v::not(v::date())->check('2018-01-29'));
exceptionFullMessage(static fn() => v::date()->assert('2018-01-29T08:32:54+00:00'));
exceptionFullMessage(static fn() => v::not(v::date('d/m/Y'))->assert('29/01/2018'));
?>
--EXPECT--
"2018-01-29T08:32:54+00:00" must be a valid date in the format "2005-12-30"
"2018-01-29" must not be a valid date in the format "2005-12-30"
- "2018-01-29T08:32:54+00:00" must be a valid date in the format "2005-12-30"
- "29/01/2018" must not be a valid date in the format "30/12/2005"
