--CREDITS--
Henrique Moody <henriquemoody@gmail.com>
Tomasz Regdos <tomek@regdos.com>
--FILE--
<?php

declare(strict_types=1);

require_once 'vendor/autoload.php';

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Exceptions\NipException;
use Respect\Validation\Validator as v;

try {
    v::nip()->check('1645865778');
} catch (NipException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::not(v::nip())->check('1645865777');
} catch (NipException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::nip()->assert('1645865778');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}

try {
    v::not(v::nip())->assert('1645865777');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}
?>
--EXPECT--
"1645865778" must be a valid Polish VAT identification number
"1645865777" must not be a valid Polish VAT identification number
- "1645865778" must be a valid Polish VAT identification number
- "1645865777" must not be a valid Polish VAT identification number
