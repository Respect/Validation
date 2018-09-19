--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\LuhnException;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

try {
    v::luhn()->check('2222400041240021');
} catch (LuhnException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::luhn())->check('2223000048400011');
} catch (LuhnException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::luhn()->assert('340316193809334');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::luhn())->assert('6011000990139424');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}
?>
--EXPECTF--
"2222400041240021" must be a valid Luhn number
"2223000048400011" must not be a valid Luhn number
- "340316193809334" must be a valid Luhn number
- "6011000990139424" must not be a valid Luhn number
