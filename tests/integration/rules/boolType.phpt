--CREDITS--
Henrique Moody <henriquemoody@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\BoolTypeException;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

try {
    v::boolType()->check('teste');
} catch (BoolTypeException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::not(v::boolType())->check(true);
} catch (BoolTypeException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::boolType()->assert([]);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}

try {
    v::not(v::boolType())->assert(false);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}
?>
--EXPECT--
"teste" must be of type boolean
`TRUE` must not be of type boolean
- `{ }` must be of type boolean
- `FALSE` must not be of type boolean
