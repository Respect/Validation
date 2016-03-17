--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\ConsonantException;

try {
    v::not(v::consonant())->check('ddd');
} catch (ConsonantException $e) {
    echo $e->getMainMessage();
}
--EXPECTF--
"ddd" must not contain consonants
