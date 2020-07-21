--CREDITS--
Henrique Moody <henriquemoody@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Exceptions\NullTypeException;
use Respect\Validation\Validator as v;

try {
    v::nullType()->check('');
} catch (NullTypeException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::not(v::nullType())->check(null);
} catch (NullTypeException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::nullType()->assert(false);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}

try {
    v::not(v::nullType())->assert(null);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}
?>
--EXPECT--
"" must be null
`NULL` must not be null
- `FALSE` must be null
- `NULL` must not be null
