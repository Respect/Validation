--FILE--
<?php

require_once 'vendor/autoload.php';

use Respect\Validation\Exceptions\AllOfException;
use Respect\Validation\Validator as v;

try {
    v::not(v::vatin('PL'))->assert('1645865777');
} catch (AllOfException $e) {
    echo $e->getFullMessage();
}
?>
--EXPECTF--
- "1645865777" must not be a valid VAT identification number for "PL"
