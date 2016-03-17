--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\AllOfException;
use Respect\Validation\Exceptions\AlphaException;
use Respect\Validation\Validator as v;

try {
    v::not(v::alpha())->check('a');
} catch (AlphaException $e) {
    echo $e->getMainMessage().PHP_EOL;
}

try {
    v::not(v::alpha())->assert('b');
} catch (AllOfException $e) {
    echo $e->getFullMessage().PHP_EOL;
}
?>
--EXPECTF--
"a" must not contain letters (a-z)
- "b" must not contain letters (a-z)
