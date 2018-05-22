--FILE--
<?php

require_once 'vendor/autoload.php';

use Respect\Validation\Exceptions\Locale\PlVatinException;
use Respect\Validation\Validator as v;

try {
    v::vatin('PL')->check('1645865778');
} catch (PlVatinException $e) {
    echo $e->getMessage();
}
?>
--EXPECTF--
"1645865778" must be a valid Polish VAT identification number
