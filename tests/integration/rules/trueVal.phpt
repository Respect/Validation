--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Exceptions\TrueValException;
use Respect\Validation\Validator as v;

try {
    v::trueVal()->check(false);
} catch (TrueValException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::trueVal())->check(1);
} catch (TrueValException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::trueVal()->assert(0);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::trueVal())->assert('true');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}
?>
--EXPECTF--
`FALSE` is not considered as "True"
1 is considered as "True"
- 0 is not considered as "True"
- "true" is considered as "True"
