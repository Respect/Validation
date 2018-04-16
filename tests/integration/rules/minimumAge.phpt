--FILE--
<?php
require 'vendor/autoload.php';

date_default_timezone_set('UTC');

use Respect\Validation\Exceptions\MinimumAgeException;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

try {
    v::minimumAge(18)->check('17 years ago');
} catch (MinimumAgeException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::minimumAge(18))->check('-30 years');
} catch (MinimumAgeException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::minimumAge(18)->assert('yesterday');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::minimumAge(18, 'd/m/Y')->assert('12/10/2010');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}
?>
--EXPECTF--
"17 years ago" must be 18 years or more
"-30 years" must not be 18 years or more
- "yesterday" must be 18 years or more
- "12/10/2010" must be 18 years or more
