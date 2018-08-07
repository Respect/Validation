--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\InfiniteException;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

try {
    v::infinite()->check(-9);
} catch (InfiniteException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::infinite())->check(INF);
} catch (InfiniteException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::infinite()->assert(new stdClass());
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::infinite())->assert(INF * -1);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

?>
--EXPECTF--
-9 must be an infinite number
`INF` must not be an infinite number
- `[object] (stdClass: { })` must be an infinite number
- `-INF` must not be an infinite number
