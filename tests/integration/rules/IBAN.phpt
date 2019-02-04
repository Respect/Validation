--CREDITS--
Mazen Touati <mazen_touati@hotmail.com>
--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Exceptions\IBANException;
use Respect\Validation\Validator as v;

try {
    v::IBAN()->check('SE35 5000 5880 7742');
} catch (IBANException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::IBAN())->check('GB82 WEST 1234 5698 7654 32');
} catch (IBANException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::IBAN()->assert('NOT AN IBAN');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::IBAN())->assert('HU93 1160 0006 0000 0000 1234 5676');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}
?>
--EXPECT--
"SE35 5000 5880 7742" must be a valid IBAN
"GB82 WEST 1234 5698 7654 32" must not be a valid IBAN
- "NOT AN IBAN" must be a valid IBAN
- "HU93 1160 0006 0000 0000 1234 5676" must not be a valid IBAN
