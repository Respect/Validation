--CREDITS--
Henrique Moody <henriquemoody@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require_once 'vendor/autoload.php';

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Exceptions\PolishIdCardException;
use Respect\Validation\Validator as v;

try {
    v::polishIdCard()->check('AYE205411');
} catch (PolishIdCardException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::not(v::polishIdCard())->check('AYE205410');
} catch (PolishIdCardException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::polishIdCard()->assert('AYE205411');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}

try {
    v::not(v::polishIdCard())->assert('AYE205410');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}
?>
--EXPECT--
"AYE205411" must be a valid Polish Identity Card number
"AYE205410" must not be a valid Polish Identity Card number
- "AYE205411" must be a valid Polish Identity Card number
- "AYE205410" must not be a valid Polish Identity Card number
