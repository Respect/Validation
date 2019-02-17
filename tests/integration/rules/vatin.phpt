--CREDITS--
Henrique Moody <henriquemoody@gmail.com>
Tomasz Regdos <tomek@regdos.com>
--FILE--
<?php

declare(strict_types=1);

require_once 'vendor/autoload.php';

use Respect\Validation\Exceptions\Locale\PlVatinException;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Exceptions\VatinException;
use Respect\Validation\Validator as v;

try {
    v::vatin('PL')->check('1645865778');
} catch (PlVatinException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::vatin('PL'))->check('1645865777');
} catch (VatinException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::vatin('PL')->assert('1645865778');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::vatin('PL'))->assert('1645865777');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}
?>
--EXPECT--
"1645865778" must be a valid Polish VAT identification number
"1645865777" must not be a valid VAT identification number for "PL"
- "1645865778" must be a valid Polish VAT identification number
- "1645865777" must not be a valid VAT identification number for "PL"
