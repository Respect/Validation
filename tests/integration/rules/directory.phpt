--CREDITS--
William Espindola <oi@williamespindola.com.br>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::directory()->check('batman'));
exceptionMessage(static fn() => v::not(v::directory())->check(dirname('/etc/')));
exceptionFullMessage(static fn() => v::directory()->assert('ppz'));
exceptionFullMessage(static fn() => v::not(v::directory())->assert(dirname('/etc/')));
?>
--EXPECT--
"batman" must be a directory
"/" must not be a directory
- "ppz" must be a directory
- "/" must not be a directory
