--CREDITS--
Henrique Moody <henriquemoody@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require_once 'vendor/autoload.php';

use Respect\Validation\Exceptions\IdentityCardException;
use Respect\Validation\Exceptions\Locale\PlIdentityCardException;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

try {
    v::identityCard('PL')->check('AYE205411');
} catch (PlIdentityCardException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::identityCard('PL'))->check('AYE205410');
} catch (IdentityCardException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::identityCard('PL')->assert('AYE205411');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::identityCard('PL'))->assert('AYE205410');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}
?>
--EXPECT--
"AYE205411" must be a valid Polish Identity Card number
"AYE205410" must not be a valid Identity Card number for "PL"
- "AYE205411" must be a valid Polish Identity Card number
- "AYE205410" must not be a valid Identity Card number for "PL"
