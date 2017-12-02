--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Exceptions\SubsetException;
use Respect\Validation\Validator as v;

try {
    v::subset([1, 2])->check([1, 2, 3]);
} catch (SubsetException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::subset([1, 2, 3]))->check([1, 2]);
} catch (SubsetException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::subset(['A', 'B'])->assert(['B', 'C']);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::subset(['A']))->assert(['A']);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}
?>
--EXPECTF--
`{ 1, 2, 3 }` must be subset of `{ 1, 2 }`
`{ 1, 2 }` must not be subset of `{ 1, 2, 3 }`
- `{ "B", "C" }` must be subset of `{ "A", "B" }`
- `{ "A" }` must not be subset of `{ "A" }`
