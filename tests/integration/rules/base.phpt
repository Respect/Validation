--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\BaseException;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

try {
    v::base(61)->check('Z01xSsg5675hic20dj');
} catch (BaseException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::base(2)->assert('');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::base(2))->check('011010001');
} catch (BaseException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::base(2))->assert('011010001');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}
?>
--EXPECTF--
"Z01xSsg5675hic20dj" must be a number in the base 61
- "" must be a number in the base 2
"011010001" must not be a number in the base 2
- "011010001" must not be a number in the base 2
