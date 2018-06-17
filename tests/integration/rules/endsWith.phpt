--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\EndsWithException;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

try {
    v::endsWith('foo')->check('bar');
} catch (EndsWithException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::endsWith('foo'))->check(['bar', 'foo']);
} catch (EndsWithException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::endsWith('foo')->assert('');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::endsWith('foo'))->assert(['bar', 'foo']);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

?>
--EXPECTF--
"bar" must end with "foo"
`{ "bar", "foo" }` must not end with "foo"
- "" must end with "foo"
- `{ "bar", "foo" }` must not end with "foo"
