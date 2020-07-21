--CREDITS--
Paul Karikari <paulkarikari1@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Exceptions\UniqueException;
use Respect\Validation\Validator as v;

try {
    v::unique()->check([1, 2, 2, 3]);
} catch (UniqueException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::not(v::unique())->check([1, 2, 3, 4]);
} catch (UniqueException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::unique()->assert('test');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}

try {
    v::not(v::unique())->assert(['a', 'b', 'c']);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}

?>
--EXPECT--
`{ 1, 2, 2, 3 }` must not contain duplicates
`{ 1, 2, 3, 4 }` must contain duplicates
- "test" must not contain duplicates
- `{ "a", "b", "c" }` must contain duplicates
