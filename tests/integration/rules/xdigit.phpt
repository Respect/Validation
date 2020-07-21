--CREDITS--
Henrique Moody <henriquemoody@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Exceptions\XdigitException;
use Respect\Validation\Validator as v;

try {
    v::xdigit()->check('aaa%a');
} catch (XdigitException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::xdigit(' ')->check('bbb%b');
} catch (XdigitException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::not(v::xdigit())->check('ccccc');
} catch (XdigitException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::not(v::xdigit('% '))->check('ddd%d');
} catch (XdigitException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::xdigit()->assert('eee^e');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}

try {
    v::not(v::xdigit())->assert('fffff');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}

try {
    v::xdigit('* &%')->assert('000^0');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}

try {
    v::not(v::xdigit('^'))->assert('111^1');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}
?>
--EXPECT--
"aaa%a" contain only hexadecimal digits
"bbb%b" contain only hexadecimal digits and " "
"ccccc" must not contain hexadecimal digits
"ddd%d" must not contain hexadecimal digits or "% "
- "eee^e" contain only hexadecimal digits
- "fffff" must not contain hexadecimal digits
- "000^0" contain only hexadecimal digits and "* &%"
- "111^1" must not contain hexadecimal digits or "^"
