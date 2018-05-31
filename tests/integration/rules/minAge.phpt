--FILE--
<?php
require 'vendor/autoload.php';

date_default_timezone_set('UTC');

use Respect\Validation\Exceptions\MinAgeException;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

try {
    v::minAge(18)->check('17 years ago');
} catch (MinAgeException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::minAge(18))->check('-30 years');
} catch (MinAgeException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::minAge(18)->assert('yesterday');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::minAge(18, 'd/m/Y')->assert('12/10/2010');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}
?>
--EXPECTF--
"17 years ago" must be 18 years or more
"-30 years" must not be 18 years or more
- "yesterday" must be 18 years or more
- "12/10/2010" must be 18 years or more
