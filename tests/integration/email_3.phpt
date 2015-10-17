--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\AllOfException;

try {
    v::email()->assert('bruce wayne');
} catch (AllOfException $e) {
    echo $e->getFullMessage();
}
?>
--EXPECTF--
\-"bruce wayne" must be valid email