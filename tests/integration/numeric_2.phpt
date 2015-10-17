--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\NumericException;
use Respect\Validation\Exceptions\AllOfException;

try {
    v::numeric()->check('a');
} catch (NumericException $e) {
    echo $e->getMainMessage().PHP_EOL;
}

try {
    v::numeric()->assert('a');
} catch (AllOfException $e) {
    echo $e->getFullMessage().PHP_EOL;
}
?>
--EXPECTF--
"a" must be numeric
\-"a" must be numeric
