--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\AllOfException;

try {
    v::not(v::consonant())->assert('bb');
} catch (AllOfException $e) {
    echo $e->getFullMessage();
}
--EXPECTF--
- "bb" must not contain consonants
