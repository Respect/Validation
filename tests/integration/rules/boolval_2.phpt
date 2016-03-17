--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\AllOfException;
use Respect\Validation\Exceptions\BoolValException;
use Respect\Validation\Validator as v;

try {
    v::boolVal()->check('ok');
} catch (BoolValException $e) {
    echo $e->getMainMessage().PHP_EOL;
}

try {
    v::not(v::boolVal())->check('yes');
} catch (BoolValException $e) {
    echo $e->getMainMessage().PHP_EOL;
}

try {
    v::boolVal()->assert('yep');
} catch (AllOfException $e) {
    echo $e->getFullMessage().PHP_EOL;
}

try {
    v::not(v::boolVal())->assert('on');
} catch (AllOfException $e) {
    echo $e->getFullMessage().PHP_EOL;
}
?>
--EXPECTF--
"ok" must be a boolean value
"yes" must not be a boolean value
- "yep" must be a boolean value
- "on" must not be a boolean value
