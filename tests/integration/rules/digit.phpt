--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\DigitException;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

try {
    v::digit()->check('abc');
} catch (DigitException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::digit('-')->check('a-b');
} catch (DigitException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::digit())->check('123');
} catch (DigitException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::digit('-'))->check('1-3');
} catch (DigitException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::digit()->assert('abc');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::digit('-')->assert('a-b');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::digit())->assert('123');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::digit('-'))->assert('1-3');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}
?>
--EXPECT--
"abc" must contain only digits (0-9)
"a-b" must contain only digits (0-9) and "-"
"123" must not contain digits (0-9)
"1-3" must not contain digits (0-9) and "-"
- "abc" must contain only digits (0-9)
- "a-b" must contain only digits (0-9) and "-"
- "123" must not contain digits (0-9)
- "1-3" must not contain digits (0-9) and "-"
