--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\AllOfException;

try {
    v::consonant()->assert('Jaspion');
} catch (AllOfException $e) {
    echo $e->getFullMessage();
}
--EXPECTF--
- "Jaspion" must contain only consonants
