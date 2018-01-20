--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\AllOfException;
use Respect\Validation\Validator as v;

try {
    v::not(v::intType()->between(1, 42))->assert(41);
} catch (AllOfException $e) {
    echo $e->getFullMessage();
}
?>
--EXPECTF--
- 41 must not be less than or equal to 42
