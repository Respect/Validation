--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\ContainsException;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

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
    v::contains('foo')->assert(['bar']);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::contains('foo', true))->assert(['bar', 'foo']);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

?>
--EXPECTF--
"bar" must contain the value "foo"
"fool" must not contain the value "foo"
- `{ "bar" }` must contain the value "foo"
- `{ "bar", "foo" }` must not contain the value "foo"
