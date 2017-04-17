--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\AlphaException;
use Respect\Validation\Exceptions\AllOfException;

try {
    v::alpha()->setName('Field')->check(null);
} catch (AlphaException $e) {
    echo $e->getMainMessage().PHP_EOL;
}

try {
    v::alpha()->setName('Field')->assert('');
} catch (AllOfException $e) {
    echo $e->getFullMessage().PHP_EOL;
}
?>
--EXPECTF--
Field must contain only letters (a-z)
\-Field must contain only letters (a-z)
