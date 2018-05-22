--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Exceptions\ResourceTypeException;
use Respect\Validation\Validator as v;

try {
    v::resourceType()->check('test');
} catch (ResourceTypeException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::resourceType())->check(tmpfile());
} catch (ResourceTypeException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::resourceType()->assert([]);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::resourceType())->assert(xml_parser_create());
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}
?>
--EXPECTF--
"test" must be a resource
`[resource] (stream)` must not be a resource
- `{ }` must be a resource
- `[resource] (xml)` must not be a resource
