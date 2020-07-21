--CREDITS--
Henrique Moody <henriquemoody@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Exceptions\RomanException;
use Respect\Validation\Validator as v;

try {
    v::roman()->check(1234);
} catch (RomanException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::not(v::roman())->check('XL');
} catch (RomanException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::roman()->assert('e2');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}

try {
    v::not(v::roman())->assert('IV');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}
?>
--EXPECT--
1234 must be a valid Roman numeral
"XL" must not be a valid Roman numeral
- "e2" must be a valid Roman numeral
- "IV" must not be a valid Roman numeral
