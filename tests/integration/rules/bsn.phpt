--CREDITS--
William Espindola <oi@williamespindola.com.br>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::bsn()->check('acb'));
exceptionMessage(static fn() => v::not(v::bsn())->check('612890053'));
exceptionFullMessage(static fn() => v::bsn()->assert('abc'));
exceptionFullMessage(static fn() => v::not(v::bsn())->assert('612890053'));
?>
--EXPECT--
"acb" must be a BSN
"612890053" must not be a BSN
- "abc" must be a BSN
- "612890053" must not be a BSN
