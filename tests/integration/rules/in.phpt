--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\InException;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

try {
    v::in([3, 2])->check(1);
} catch (InException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::in('foobar'))->check('foo');
} catch (InException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::in([2, '1', 3], true)->assert('2');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::in([2, '1', 3], true))->assert('1');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}
?>
--EXPECTF--
1 must be in `{ 3, 2 }`
"foo" must not be in "foobar"
- "2" must be in `{ 2, "1", 3 }`
- "1" must not be in `{ 2, "1", 3 }`
