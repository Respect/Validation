--CREDITS--
Henrique Moody <henriquemoody@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\GreaterThanException;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

try {
    v::greaterThan(21)->check(12);
} catch (GreaterThanException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::not(v::greaterThan('yesterday'))->check('today');
} catch (GreaterThanException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::greaterThan('2018-09-09')->assert('1988-09-09');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}

try {
    v::not(v::greaterThan('a'))->assert('ba');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}
?>
--EXPECT--
12 must be greater than 21
"today" must not be greater than "yesterday"
- "1988-09-09" must be greater than "2018-09-09"
- "ba" must not be greater than "a"
