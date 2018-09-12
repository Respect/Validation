--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Exceptions\NotOptionalException;
use Respect\Validation\Validator as v;

try {
    v::notOptional()->check(null);
} catch (NotOptionalException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::notOptional())->check(0);
} catch (NotOptionalException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::notOptional()->setName('Field')->check(null);
} catch (NotOptionalException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::notOptional()->setName('Field'))->check([]);
} catch (NotOptionalException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::notOptional()->assert('');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::notOptional())->assert([]);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::notOptional()->setName('Field')->assert('');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::notOptional()->setName('Field'))->assert([]);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}
?>
--EXPECTF--
The value must not be optional
The value must be optional
Field must not be optional
Field must be optional
- The value must not be optional
- The value must be optional
- Field must not be optional
- Field must be optional
