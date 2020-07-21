--CREDITS--
Danilo Correa <danilosilva87@gmail.com>
Henrique Moody <henriquemoody@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Exceptions\SortedException;
use Respect\Validation\Validator as v;

try {
    v::sorted('ASC')->check([1, 3, 2]);
} catch (SortedException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::sorted('DESC')->check([1, 2, 3]);
} catch (SortedException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::not(v::sorted('ASC'))->check([1, 2, 3]);
} catch (SortedException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::not(v::sorted('DESC'))->check([3, 2, 1]);
} catch (SortedException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::sorted('ASC')->assert([3, 2, 1]);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}

try {
    v::sorted('DESC')->assert([1, 2, 3]);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}

try {
    v::not(v::sorted('ASC'))->assert([1, 2, 3]);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}

try {
    v::not(v::sorted('DESC'))->assert([3, 2, 1]);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}
?>
--EXPECT--
`{ 1, 3, 2 }` must be sorted in ascending order
`{ 1, 2, 3 }` must be sorted in descending order
`{ 1, 2, 3 }` must not be sorted in ascending order
`{ 3, 2, 1 }` must not be sorted in descending order
- `{ 3, 2, 1 }` must be sorted in ascending order
- `{ 1, 2, 3 }` must be sorted in descending order
- `{ 1, 2, 3 }` must not be sorted in ascending order
- `{ 3, 2, 1 }` must not be sorted in descending order
