--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\BetweenException;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

try {
    v::between(1, 2)->check(0);
} catch (BetweenException $e) {
    echo $e->getMessage().PHP_EOL;
}

try {
    v::not(v::between('yesterday', 'tomorrow'))->check('today');
} catch (BetweenException $e) {
    echo $e->getMessage().PHP_EOL;
}

try {
    v::between('a', 'c')->assert('d');
} catch (NestedValidationException $e) {
    echo $e->getFullMessage().PHP_EOL;
}

try {
    v::not(v::between(-INF, INF))->assert(0);
} catch (NestedValidationException $e) {
    echo $e->getFullMessage().PHP_EOL;
}

?>
--EXPECTF--
0 must be between 1 and 2
"today" must not be between "yesterday" and "tomorrow"
- "d" must be between "a" and "c"
- 0 must not be between `-INF` and `INF`
