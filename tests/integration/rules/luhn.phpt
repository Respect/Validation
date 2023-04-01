--CREDITS--
Danilo Correa <danilosilva87@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::luhn()->check('2222400041240021'));
exceptionMessage(static fn() => v::not(v::luhn())->check('2223000048400011'));
exceptionFullMessage(static fn() => v::luhn()->assert('340316193809334'));
exceptionFullMessage(static fn() => v::not(v::luhn())->assert('6011000990139424'));
?>
--EXPECT--
"2222400041240021" must be a valid Luhn number
"2223000048400011" must not be a valid Luhn number
- "340316193809334" must be a valid Luhn number
- "6011000990139424" must not be a valid Luhn number
