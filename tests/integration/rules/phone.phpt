--CREDITS--
Danilo Correa <danilosilva87@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Exceptions\PhoneException;
use Respect\Validation\Validator as v;

try {
    v::phone()->check('123');
} catch (PhoneException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::not(v::phone())->check('+1 650 253 00 00');
} catch (PhoneException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::phone()->assert('(555)5555 555');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}

try {
    v::not(v::phone())->assert('+55 11 91111 1111');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}
?>
--EXPECT--
"123" must be a valid telephone number
"+1 650 253 00 00" must not be a valid telephone number
- "(555)5555 555" must be a valid telephone number
- "+55 11 91111 1111" must not be a valid telephone number
