--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\AllOfException;
use Respect\Validation\Validator as v;

try {
    v::allOf(v::stringType(), v::consonant())->assert(42);
} catch (AllOfException $e) {
    echo $e->getFullMessage();
}
?>
--EXPECTF--
- All of the required rules must pass for 42
  - 42 must be a string
  - 42 must contain only consonants
