--CREDITS--
Henrique Moody <henriquemoody@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Exceptions\PostalCodeException;
use Respect\Validation\Validator as v;

try {
    v::postalCode('BR')->check('1057BV');
} catch (PostalCodeException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::not(v::postalCode('NL'))->check('1057BV');
} catch (PostalCodeException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::postalCode('BR')->assert('1057BV');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}

try {
    v::not(v::postalCode('NL'))->assert('1057BV');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}
?>
--EXPECT--
"1057BV" must be a valid postal code on "BR"
"1057BV" must not be a valid postal code on "NL"
- "1057BV" must be a valid postal code on "BR"
- "1057BV" must not be a valid postal code on "NL"
