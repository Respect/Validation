--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\AlnumException;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

try {
    v::alnum()->check('abc%1');
} catch (AlnumException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::alnum(' ')->check('abc%2');
} catch (AlnumException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::alnum())->check('abcd3');
} catch (AlnumException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::alnum('% '))->check('abc%4');
} catch (AlnumException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::alnum()->assert('abc^1');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::alnum())->assert('abcd2');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::alnum('* &%')->assert('abc^3');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::alnum('^'))->assert('abc^4');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}
?>
--EXPECTF--
"abc%1" must contain only letters (a-z) and digits (0-9)
"abc%2" must contain only letters (a-z), digits (0-9) and " "
"abcd3" must not contain letters (a-z) or digits (0-9)
"abc%4" must not contain letters (a-z), digits (0-9) or "% "
- "abc^1" must contain only letters (a-z) and digits (0-9)
- "abcd2" must not contain letters (a-z) or digits (0-9)
- "abc^3" must contain only letters (a-z), digits (0-9) and "* &%"
- "abc^4" must not contain letters (a-z), digits (0-9) or "^"
