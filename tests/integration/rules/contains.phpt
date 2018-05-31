--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\AllOfException;
use Respect\Validation\Exceptions\ContainsException;
use Respect\Validation\Validator as v;

try {
    v::contains('foo', true)->check('bar');
} catch (ContainsException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::contains('foo')->check('bar');
} catch (ContainsException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::contains('foo'))->check('fool');
} catch (ContainsException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::contains('foo', true))->check(['bar', 'foo']);
} catch (ContainsException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::contains('foo', true)->assert(['bar']);
} catch (AllOfException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::contains('foo')->assert(['bar']);
} catch (AllOfException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::contains('foo', true))->assert(['bar', 'foo']);
} catch (AllOfException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::contains('1', true)->check([2, 3, 11, '11']);
} catch (ContainsException $exception) {
    echo $exception->getMessage().PHP_EOL;
}
?>
--EXPECTF--
"bar" must contain the value ""foo""
"bar" must contain the value ""foo""
"fool" must not contain the value ""foo""
`{ "bar", "foo" }` must not contain the value ""foo""
- `{ "bar" }` must contain the value ""foo""
- `{ "bar" }` must contain the value ""foo""
- `{ "bar", "foo" }` must not contain the value ""foo""
`{ 2, 3, 11, "11" }` must contain the value ""1""
