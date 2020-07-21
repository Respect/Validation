--CREDITS--
Emmerson Siqueira <emmersonsiqueira@gmail.com>
Henrique Moody <henriquemoody@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\ArrayTypeException;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

try {
    v::arrayType()->check('teste');
} catch (ArrayTypeException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::not(v::arrayType())->check([]);
} catch (ArrayTypeException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::arrayType()->assert(new ArrayObject());
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}

try {
    v::not(v::arrayType())->assert([1, 2, 3]);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}
?>
--EXPECT--
"teste" must be of type array
`{ }` must not be of type array
- `[traversable] (ArrayObject: { })` must be of type array
- `{ 1, 2, 3 }` must not be of type array
