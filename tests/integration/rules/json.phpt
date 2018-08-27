--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\JsonException;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

try {
    v::json()->check(false);
} catch (JsonException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::json())->check('{"foo": "bar", "number":1}');
} catch (JsonException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::json()->assert(new \stdClass());
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::json())->assert('{}');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}
?>
--EXPECTF--
`FALSE` must be a valid JSON string
"{\"foo\": \"bar\", \"number\":1}" must not be a valid JSON string
- `[object] (stdClass: { })` must be a valid JSON string
- "{}" must not be a valid JSON string
