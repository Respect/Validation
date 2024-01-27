--CREDITS--
Danilo Benevides <danilobenevides01@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::imei()->check('490154203237512'));
exceptionMessage(static fn() => v::not(v::imei())->check('350077523237513'));
exceptionFullMessage(static fn() => v::imei()->assert(null));
exceptionFullMessage(static fn() => v::not(v::imei())->assert('356938035643809'));
?>
--EXPECT--
"490154203237512" must be a valid IMEI
"350077523237513" must not be a valid IMEI
- `NULL` must be a valid IMEI
- "356938035643809" must not be a valid IMEI
