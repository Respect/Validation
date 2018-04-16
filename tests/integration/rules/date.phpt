--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\DateException;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

try {
    v::date()->check('2018-01-29T08:32:54+00:00');
} catch (DateException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::date())->check('2018-01-29');
} catch (DateException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::date()->assert('2018-01-29T08:32:54+00:00');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::date('d/m/Y'))->assert('29/01/2018');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}
?>
--EXPECTF--
"2018-01-29T08:32:54+00:00" must be a valid date in the format "2005-12-30"
"2018-01-29" must not be a valid date in the format "2005-12-30"
- "2018-01-29T08:32:54+00:00" must be a valid date in the format "2005-12-30"
- "29/01/2018" must not be a valid date in the format "30/12/2005"
