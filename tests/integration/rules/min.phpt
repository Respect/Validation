--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\MinException;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

try {
    v::min(INF)->check(10);
} catch (MinException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::min(5))->check(INF);
} catch (MinException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::min('today')->assert('yesterday');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::min('a'))->assert('z');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}
?>
--EXPECTF--
10 must be greater than or equal to `INF`
`INF` must not be greater than or equal to 5
- "yesterday" must be greater than or equal to "today"
- "z" must not be greater than or equal to "a"
