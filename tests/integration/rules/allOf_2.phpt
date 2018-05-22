--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\ConsonantException;
use Respect\Validation\Validator as v;

try {
    v::allOf(v::stringType(), v::consonant())->check('Luke i\'m your father');
} catch (ConsonantException $e) {
    echo $e->getMessage();
}
?>
--EXPECTF--
"Luke i'm your father" must contain only consonants
