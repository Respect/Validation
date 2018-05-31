--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Exceptions\PrintableException;
use Respect\Validation\Validator as v;

try {
    v::printable()->check('');
} catch (PrintableException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::printable())->check('abc');
} catch (PrintableException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::printable()->assert('foo'.chr(10).'bar');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::printable())->assert('$%asd');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}
?>
--EXPECTF--
"" must contain only printable characters
"abc" must not contain printable characters
- "foo\nbar" must contain only printable characters
- "$%asd" must not contain printable characters
