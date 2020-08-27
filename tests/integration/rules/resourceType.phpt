--CREDITS--
Henrique Moody <henriquemoody@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Exceptions\ResourceTypeException;
use Respect\Validation\Validator as v;

try {
    v::resourceType()->check('test');
} catch (ResourceTypeException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::not(v::resourceType())->check(tmpfile());
} catch (ResourceTypeException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::resourceType()->assert([]);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}

try {
    v::not(v::resourceType())->assert(tmpfile());
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}
?>
--EXPECT--
"test" must be a resource
`[resource] (stream)` must not be a resource
- `{ }` must be a resource
- `[resource] (stream)` must not be a resource
