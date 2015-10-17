--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\NotOptionalException;
use Respect\Validation\Exceptions\AllOfException;

try {
    v::not(v::notOptional())->check(0);
} catch (NotOptionalException $e) {
    echo $e->getMainMessage().PHP_EOL;
}

try {
    v::not(v::notOptional())->assert(array());
} catch (AllOfException $e) {
    echo $e->getFullMessage().PHP_EOL;
}

try {
    v::not(v::notOptional()->setName('Field'))->assert(array());
} catch (AllOfException $e) {
    echo $e->getFullMessage().PHP_EOL;
}
?>
--EXPECTF--
The value must be optional
\-{ } must be optional
\-Field must be optional
