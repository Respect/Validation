--CREDITS--
Henrique Moody <henriquemoody@gmail.com>
Julián Gutiérrez <juliangut@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::nif()->check('06357771Q'));
exceptionMessage(static fn() => v::not(v::nif())->check('71110316C'));
exceptionFullMessage(static fn() => v::nif()->assert('06357771Q'));
exceptionFullMessage(static fn() => v::not(v::nif())->assert('R1332622H'));
?>
--EXPECT--
"06357771Q" must be a NIF
"71110316C" must not be a NIF
- "06357771Q" must be a NIF
- "R1332622H" must not be a NIF
