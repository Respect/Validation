--CREDITS--
Danilo Correa <danilosilva87@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Exceptions\SortedException;
use Respect\Validation\Validator as v;

$fn = static function ($x) {
    return $x['key'];
};

try {
    v::sorted()->check([1, 2, 5, 4]);
} catch (SortedException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::sorted(null, false)->check([1, 2, 3]);
} catch (SortedException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::sorted($fn)->check([
        ['key' => 1],
        ['key' => 5],
        ['key' => 4],
    ]);
} catch (SortedException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::sorted($fn, false)->check([
        ['key' => 1],
        ['key' => 2],
        ['key' => 3],
    ]);
} catch (SortedException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::sorted())->check([1, 2, 2, 3]);
} catch (SortedException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::sorted(null, false))->check([3, 2, 1]);
} catch (SortedException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::sorted($fn))->check([
        ['key' => 1],
        ['key' => 2],
        ['key' => 3],
    ]);
} catch (SortedException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::sorted($fn, false))->check([
        ['key' => 4],
        ['key' => 2],
        ['key' => 1],
    ]);
} catch (SortedException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::sorted()->assert([1, 2, 5, 4]);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::sorted(null, false)->assert([1, 2, 3]);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::sorted($fn)->assert([
        ['key' => 1],
        ['key' => 5],
        ['key' => 4],
    ]);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::sorted($fn, false)->assert([
        ['key' => 1],
        ['key' => 2],
        ['key' => 3],
    ]);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::sorted())->assert([1, 2, 2, 3]);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::sorted(null, false))->assert([3, 2, 1]);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::sorted($fn))->assert([
        ['key' => 1],
        ['key' => 2],
        ['key' => 3],
    ]);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::sorted($fn, false))->assert([
        ['key' => 4],
        ['key' => 2],
        ['key' => 1],
    ]);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

?>
--EXPECT--
`{ 1, 2, 5, 4 }` must be ordered
`{ 1, 2, 3 }` must be ordered
`{ { "key": 1 }, { "key": 5 }, { "key": 4 } }` must be ordered
`{ { "key": 1 }, { "key": 2 }, { "key": 3 } }` must be ordered
`{ 1, 2, 2, 3 }` must not be ordered
`{ 3, 2, 1 }` must not be ordered
`{ { "key": 1 }, { "key": 2 }, { "key": 3 } }` must not be ordered
`{ { "key": 4 }, { "key": 2 }, { "key": 1 } }` must not be ordered
- `{ 1, 2, 5, 4 }` must be ordered
- `{ 1, 2, 3 }` must be ordered
- `{ { "key": 1 }, { "key": 5 }, { "key": 4 } }` must be ordered
- `{ { "key": 1 }, { "key": 2 }, { "key": 3 } }` must be ordered
- `{ 1, 2, 2, 3 }` must not be ordered
- `{ 3, 2, 1 }` must not be ordered
- `{ { "key": 1 }, { "key": 2 }, { "key": 3 } }` must not be ordered
- `{ { "key": 4 }, { "key": 2 }, { "key": 1 } }` must not be ordered