--CREDITS--
Danilo Correa <danilosilva87@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::pis()->check('this thing'));
exceptionMessage(static fn() => v::not(v::pis())->check('120.6671.406-4'));
exceptionFullMessage(static fn() => v::pis()->assert('your mother'));
exceptionFullMessage(static fn() => v::not(v::pis())->assert('120.9378.174-5'));
?>
--EXPECT--
"this thing" must be a valid PIS number
"120.6671.406-4" must not be a valid PIS number
- "your mother" must be a valid PIS number
- "120.9378.174-5" must not be a valid PIS number
