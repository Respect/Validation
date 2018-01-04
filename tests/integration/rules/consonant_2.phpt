--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\ConsonantException;
use Respect\Validation\Validator as v;

try {
    v::consonant()->assert('top nos falsetes');
} catch (ConsonantException $e) {
    echo $e->getMainMessage();
}
?>
--EXPECTF--
"top nos falsetes" must contain only consonants
