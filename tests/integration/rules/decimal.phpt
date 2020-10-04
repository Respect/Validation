--CREDITS--
Henrique Moody <henriquemoody@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\DecimalException;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

try {
    v::decimal(3)->check(0.1234);
} catch (DecimalException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::decimal(2)->assert(0.123);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}

try {
    v::not(v::decimal(5))->check(0.12345);
} catch (DecimalException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::not(v::decimal(2))->assert(0.34);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}
?>
--EXPECT--
0.1234 must have 3 decimals
- 0.123 must have 2 decimals
0.12345 must not have 5 decimals
- 0.34 must not have 2 decimals
