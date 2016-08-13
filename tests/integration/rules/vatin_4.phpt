--FILE--
<?php

require_once 'vendor/autoload.php';

use Respect\Validation\Exceptions\VatinException;
use Respect\Validation\Validator as v;

try {
    v::not(v::vatin('PL'))->check('1645865777');
} catch (VatinException $e) {
    echo $e->getMainMessage();
}
?>
--EXPECTF--
"1645865777" must not be a valid VAT identification number for "PL"
